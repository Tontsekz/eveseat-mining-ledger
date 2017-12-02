@extends('mining-ledger::corporation.layouts.view', ['sub_viewname' => 'tracking'])

@section('title', trans_choice('web::seat.corporation', 1) . ' | ' . trans('mining-ledger::seat.mining') . ' ' . trans('mining-ledger::seat.tracking'))
@section('page_header', trans_choice('web::seat.corporation', 1) . ' ' . trans('mining-ledger::seat.mining') . ' ' . trans('mining-ledger::seat.tracking'))

@section('mining_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('mining-ledger::seat.tracking') }}</h3>
        </div>
        <div class="panel-body">
            <table class="table compact table-condensed table-hover table-responsive" id="corporation-mining-ledger-tracking">
                <thead>
                    <tr>
                        <th>{{ trans_choice('web::seat.name', 1) }}</th>
                        <th>{{ trans('web::seat.joined') }}</th>
                        <th>{{ trans('web::seat.location') }}</th>
                        <th>{{ trans('web::seat.last_login') }}</th>
                        <th>{{ trans('mining-ledger::seat.expires_at') }}</th>
                        <th>{{ trans('web::seat.key') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($members as $member)
                    <tr>
                        <td>
                            {!! img('character', $member->characterID, 32, ['class' => 'img-circle eve-icon small-icon']) !!}
                            <a href="{{ route('character.view.sheet', ['character_id' => $member->characterID]) }}">{{ $member->name }}</a>
                        </td>
                        <td>
                            <span data-toggle="tooltip" data-placement="top" title="{{ $member->startDateTime }}">{{ human_diff($member->startDateTime) }}</span>
                        </td>
                        <td>{{ $member->location }}</td>
                        <td>
                            <span data-toggle="tooltip" title="" data-original-title="{{ $member->logonDateTime }}">
                                {{ human_diff($member->logonDateTime) }}
                            </span>
                        </td>
                        <td>
                            @if(!is_null($member->token))
                                <span data-toggle="tooltip" data-placement="top" title="{{ $member->token->expires_at }}">
                                {{ carbon($member->token->expires_at)->diffForHumans(\Carbon\Carbon::now('UTC')) }}
                            </span>
                            @endif
                        </td>
                        <td>
                            @if(is_null($member->token))
                                <i class="fa fa-warning text-danger"></i>
                            @else
                                <i class="fa fa-check text-success"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
