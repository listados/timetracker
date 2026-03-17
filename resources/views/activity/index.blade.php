<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">{{ __('Dashboard') }}</h2>
    </x-slot>
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">{{$activity[0]->project->name}}</h5>
                        <div class="card-header-action">
                            <div class="card-header-btn">
                                <div data-bs-toggle="tooltip" title="" data-bs-original-title="Delete">
                                    <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                </div>
                                <div data-bs-toggle="tooltip" title="" data-bs-original-title="Refresh">
                                    <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                                </div>
                                <div data-bs-toggle="tooltip" title="" data-bs-original-title="Maximize/Minimize">
                                    <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                    <div data-bs-toggle="tooltip" title="" data-bs-original-title="Options">
                                        <i class="feather-more-vertical"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item"><i class="feather-at-sign"></i>New</a>
                                    <a href="javascript:void(0);" class="dropdown-item"><i class="feather-calendar"></i>Event</a>
                                    <a href="javascript:void(0);" class="dropdown-item"><i class="feather-bell"></i>Snoozed</a>
                                    <a href="javascript:void(0);" class="dropdown-item"><i class="feather-trash-2"></i>Deleted</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0);" class="dropdown-item"><i class="feather-settings"></i>Settings</a>
                                    <a href="javascript:void(0);" class="dropdown-item"><i class="feather-life-buoy"></i>Tips &amp; Tricks</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body custom-card-action p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Iniciado</th>
                                    <th scope="col">Finalizado</th>
                                    <th scope="col">Durou</th>
                                    <th scope="col" class="text-end">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($activity as $activities)
                                <tr>
                                    <td>
                                        <div class="hstack gap-3 ">
                                            <div class="avatar-text bg-soft-primary text-primary">
                                                <i class="feather-clock"></i>
                                            </div>
                                            <div>
                                                <label class="fw-bold d-block mb-1">{{$activities->title}}</label>
                                                <div class="d-flex gap-3">
                                                    <span class="hstack gap-1 fs-11 fw-normal text-muted">
                                                        {{$activities->description}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fs-12 fw-medium mb-2">
                                            {{$activities->started_at}}
                                        </div>

                                    </td>
                                    <td>
                                        {{$activities->ended_at}}
                                    </td>
                                    <td class="">
                                        {{$activities->duration_minutes}} min.
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="javascript:void(0);"
                                               data-bs-toggle="modal" data-bs-target="#editActivity-{{$activities->id}}"
                                               title="editar" class="avatar-text avatar-md">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="avatar-text avatar-md">
                                                <i class="feather-printer"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="avatar-text avatar-md">
                                                <i class="feather-bell"></i>
                                            </a>
                                        </div>
                                    </td>
                                    @push('modals')
                                        <div class="modal fade" id="editActivity-{{$activities->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar Atividade</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{$activities->title}}</p>
                                                        <form>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="">
                                                                        <label class="col-form-label">Titulo:</label>
                                                                        <input type="text" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="">
                                                                        <label class="col-form-label">Descrição:</label>
                                                                        <input type="text" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="message-text" class="col-form-label">Message:</label>
                                                                        <textarea class="form-control" id="message-text"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                </div>




                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpush
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
