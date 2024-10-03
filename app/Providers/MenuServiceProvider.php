<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\KanbanMainCategory;
use App\Models\KanbanBoard;
use App\Models\MainCategory;
use App\Models\RuleTable;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
        $verticalMenuData = json_decode($verticalMenuJson);
        $horizontalMenuJson = file_get_contents(base_path('resources/menu/horizontalMenu.json'));
        $horizontalMenuData = json_decode($horizontalMenuJson);

        $kanbanMainCategories = KanbanMainCategory::all();
        $kanbanBoards = KanbanBoard::with('lists')->get();

        $mainCategories = MainCategory::with('tables')->get();
        $RuleTables = \App\Models\RuleTableMainCategories::with('rules.ruleTableSb')->get();


        $categoriesWithBoards = $kanbanMainCategories->map(function ($category) use ($kanbanBoards) {
            return [
                'category' => $category,
                'boards' => $kanbanBoards->filter(function ($board) use ($category) {
                    return $board->main === $category->id;
                }),
            ];
        });

        View::share([
            'kanbanCategoriesWithBoards' => $categoriesWithBoards,
            'mainCategories' => $mainCategories,
            'categories' => $RuleTables

        ]);
    }
}
