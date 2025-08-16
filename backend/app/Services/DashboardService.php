<?php

namespace App\Services;

use App\Models\Dashboard;
use App\Models\Version;
use App\Models\Widget;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getDashboardById(int $id): Dashboard
    {
        $dashboard = Dashboard::findOrFail($id);
        return $dashboard->load('currentVersion.widgets');
    }

    public function getDashboardVersionsById(int $id)
    {
        $dashboard = Dashboard::findOrFail($id);
        return $dashboard->versions()->select('id', 'number')->get();
    }

    public function updateDashboardById(int $id, array $data): Dashboard
    {
        $dashboard = Dashboard::findOrFail($id);
        return $this->updateDashboard($dashboard, $data);
    }

    public function rollbackDashboardById(int $id, int $versionId): Dashboard
    {
        $dashboard = Dashboard::findOrFail($id);
        return $this->rollbackDashboard($dashboard, $versionId);
    }

    /**
     * Get user's dashboards with search, sorting, pagination
     */
    public function getUserDashboards(int $userId, array $filters)
    {
        $query = Dashboard::with('currentVersion')
            ->where('user_id', $userId);

        // Search
        if (!empty($filters['search'])) {
            $query->where('name', 'LIKE', '%' . $filters['search'] . '%');
        }

        // Sorting
        $sortField = $filters['sort'] ?? 'created_at';
        $direction = $filters['direction'] ?? 'desc';
        $allowedSorts = ['name', 'created_at', 'updated_at'];

        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'created_at';
        }
        if (!in_array(strtolower($direction), ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $query->orderBy($sortField, $direction);

        // Pagination
        $perPage = $filters['per_page'] ?? 10;
        return $query->paginate($perPage);
    }

    /**
     * Get the current version of a dashboard with widgets
     */
    public function getDashboard(Dashboard $dashboard): Dashboard
    {
        return $dashboard->load('currentVersion.widgets');
    }

    /**
     * Get all version IDs of a dashboard
     */
    public function getDashboardVersions(Dashboard $dashboard)
    {
        return $dashboard->versions()->select('id', 'number')->get();
    }

    /**
     * Create a new dashboard with first version and widgets
     */
    public function createDashboard(array $data, int $userId): Dashboard
    {
        return DB::transaction(function () use ($data, $userId) {
            $dashboard = Dashboard::create([
                'user_id' => $userId,
                'name'    => $data['name'],
            ]);

            $version = Version::create([
                'dashboard_id' => $dashboard->id,
                'number'       => 1,
            ]);

            foreach ($data['widgets'] ?? [] as $widgetData) {
                Widget::create([
                    'version_id' => $version->id,
                    'type'       => $widgetData['type'],
                    'data'       => $widgetData['data'],
                    'sort'       => $widgetData['sort'] ?? 1,
                ]);
            }

            $dashboard->update(['current_version_id' => $version->id]);

            return $dashboard->load('currentVersion.widgets');
        });
    }

    /**
     * Update dashboard → create new version with widgets
     */
    public function updateDashboard(Dashboard $dashboard, array $data): Dashboard
    {
        return DB::transaction(function () use ($dashboard, $data) {
            $lastNumber = $dashboard->versions()->max('number') ?? 0;

            $version = Version::create([
                'dashboard_id' => $dashboard->id,
                'number'       => $lastNumber + 1,
            ]);

            foreach ($data['widgets'] ?? [] as $widgetData) {
                Widget::create([
                    'version_id' => $version->id,
                    'type'       => $widgetData['type'],
                    'data'       => $widgetData['data'],
                    'sort'       => $widgetData['sort'] ?? 1,
                ]);
            }

            $dashboard->update(['current_version_id' => $version->id]);

            return $dashboard->fresh()->load('currentVersion.widgets');
        });
    }

    /**
     * Rollback dashboard to a previous version
     */
    public function rollbackDashboard(Dashboard $dashboard, int $versionId): Dashboard
    {
        $version = $dashboard->versions()->findOrFail($versionId);
        $dashboard->update(['current_version_id' => $version->id]);
        return $dashboard->fresh()->load('currentVersion.widgets');
    }
}
