<?php

use App\Models\User;
use App\Models\Dashboard;
use App\Services\DashboardService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->service = new DashboardService();
});

it('creates a dashboard with initial version and widgets', function () {
    $data = [
        'name' => 'My Dashboard',
        'widgets' => [
            ['type' => 'chart', 'data' => ['x' => 1], 'sort' => 1],
            ['type' => 'table', 'data' => ['y' => 2], 'sort' => 2],
        ],
    ];

    $dashboard = $this->service->createDashboard($data, $this->user->id);

    expect($dashboard->name)->toBe('My Dashboard')
        ->and($dashboard->currentVersion->widgets)->toHaveCount(2);
});

it('updates a dashboard by creating a new version', function () {
    $dashboard = Dashboard::factory()->for($this->user)->create();
    $this->service->updateDashboard($dashboard, [
        'widgets' => [
            ['type' => 'chart', 'data' => ['a' => 10]],
        ]
    ]);

    $dashboard->refresh();
    expect($dashboard->versions)->toHaveCount(1)
        ->and($dashboard->currentVersion->widgets)->toHaveCount(1);
});

it('rolls back to a previous version', function () {
    $dashboard = $this->service->createDashboard(['name' => 'Rollback Test'], $this->user->id);

    $updated = $this->service->updateDashboard($dashboard, [
        'widgets' => [
            ['type' => 'chart', 'data' => ['z' => 100]],
        ]
    ]);

    $rollback = $this->service->rollbackDashboard($updated, $dashboard->versions()->first()->id);

    expect($rollback->currentVersion->id)->toBe($dashboard->versions()->first()->id);
});

it('retrieves a dashboard with widgets', function () {
    $dashboard = $this->service->createDashboard(['name' => 'View Test'], $this->user->id);

    $result = $this->service->getDashboard($dashboard);

    expect($result->currentVersion->widgets)->toHaveCount(0);
});

it('retrieves user dashboards with pagination, sorting, and search', function () {
    Dashboard::factory()->for($this->user)->count(3)->create(['name' => 'Test Dashboard']);

    $dashboards = $this->service->getUserDashboards($this->user->id, [
        'search' => 'Test',
        'sort' => 'name',
        'direction' => 'asc',
        'per_page' => 2,
    ]);

    expect($dashboards->total())->toBe(3)
        ->and($dashboards->perPage())->toBe(2);
});
