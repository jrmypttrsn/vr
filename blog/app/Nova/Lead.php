<?php

namespace App\Nova;

use Actionable;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use App\Nova\Filters\LeadType;
use Laravel\Nova\Fields\Select;
use App\Nova\Filters\LeadStatus;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Lead extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Lead';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'full_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'full_name',
        'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Full Name')
                ->exceptOnForms()
                ->sortable(),
            Select::make('Status')
                ->options(\App\Lead::getStatuses())
                ->sortable()
                ->rules('required', 'string'),
            Select::make('Type')
                ->options(\App\Lead::getTypes())
                ->sortable()
                ->rules('required', 'string'),
            Text::make('First Name')
                ->onlyOnForms()
                ->rules('required', 'string'),
            Text::make('Last Name')
                ->onlyOnForms()
                ->rules('required', 'string'),
            Text::make('Email')
                ->sortable()
                ->rules('required', 'email')
                ->creationRules('unique:leads,email')
                ->updateRules('unique:leads,email,{{ resourceID }}'),
            HasMany::make('Notes'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new Metrics\LeadsPerDay)->width('1/3'),
            (new Metrics\NewLeads)->width('1/3'),
            (new Metrics\LeadsPerStatus)->width('1/3'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Filters\LeadStatus,
            new Filters\LeadType,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            new Lenses\TimeIntensiveLeads,
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new Actions\UpdateLeadStatus,
        ];
    }
}
