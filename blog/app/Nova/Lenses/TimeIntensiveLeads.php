<?php

namespace App\Nova\Lenses;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Lenses\Lens;
use App\Nova\Filters\LeadType;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use App\Nova\Filters\LeadStatus;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\LensRequest;

class TimeIntensiveLeads extends Lens
{
    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->select([
                'leads.id',
                'leads.full_name',
                'leads.email',
                'leads.status',
                'leads.type',
                DB::raw('count(notes.id) as Count')
            ])
            ->join('notes', 'leads.id', '=', 'notes.lead_id')
            ->orderBy('Count', 'desc')
            ->groupBy('leads.id', 'leads.full_name')
        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID', 'id')->sortable(),
            Text::make('Full Name')->sortable(),
            Select::make('Status')->sortable(),
            Text::make('Type')->sortable(),
            Text::make('Email')->sortable(),
            Number::make('Notes Count', 'Count'),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new LeadStatus,
            new LeadType,
        ];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'time-intensive-leads';
    }
}
