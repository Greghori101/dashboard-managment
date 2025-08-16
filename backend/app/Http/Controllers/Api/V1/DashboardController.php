<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\IndexRequest;
use App\Http\Requests\Dashboard\StoreRequest;
use App\Http\Requests\Dashboard\UpdateRequest;
use App\Http\Resources\DashboardResource;
use App\Services\DashboardService;
use App\Http\Traits\ApiResponse;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    use ApiResponse;

    public function __construct(private DashboardService $dashboardService) {}

    public function index(IndexRequest $request)
    {
        $filters = $request->only(['search', 'sort', 'direction', 'per_page']);
        $dashboards = $this->dashboardService->getUserDashboards($request->user()->id, $filters);

        return $this->paginatedResponse(
            $dashboards,
            'Dashboards retrieved successfully'
        );
    }

    public function show(int $id)
    {
        $dashboard = $this->dashboardService->getDashboardById($id);
        Gate::authorize('view', $dashboard);

        return $this->successResponse(
            new DashboardResource($dashboard),
            'Dashboard retrieved successfully'
        );
    }

    public function store(StoreRequest $request)
    {
        $dashboard = $this->dashboardService->createDashboard($request->all(), $request->user()->id);

        return $this->successResponse(
            new DashboardResource($dashboard),
            'Dashboard created successfully',
            201
        );
    }

    public function update(UpdateRequest $request, int $id)
    {
        $dashboard = $this->dashboardService->updateDashboardById($id, $request->all());
        Gate::authorize('update', $dashboard);

        return $this->successResponse(
            new DashboardResource($dashboard),
            'Dashboard updated successfully'
        );
    }

    public function versions(int $id)
    {
        $versions = $this->dashboardService->getDashboardVersionsById($id);

        return $this->successResponse(
            $versions,
            'Dashboard versions retrieved successfully'
        );
    }

    public function rollback(int $id, int $versionId)
    {
        $dashboard = $this->dashboardService->rollbackDashboardById($id, $versionId);
        Gate::authorize('rollback', $dashboard);

        return $this->successResponse(
            new DashboardResource($dashboard),
            'Dashboard rolled back successfully'
        );
    }
}
