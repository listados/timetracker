<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">{{ __('Dashboard') }}</h2>
    </x-slot>
    <div class="py-4">
        <div class="container-xl">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">Todos os projetos</h5>
                            <div class="card-header-action">
                                <div class="card-header-btn">
                                    <div data-bs-toggle="tooltip" title="Delete">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                    </div>
                                    <div data-bs-toggle="tooltip" title="Refresh">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning"
                                           data-bs-toggle="refresh"> </a>
                                    </div>
                                    <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                        <div data-bs-toggle="tooltip" title="Options">
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
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="feather-life-buoy"></i>Tips & Tricks</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body custom-card-action p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr class="border-b">

                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Ativo</th>
                                        <th>Criado</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($projects as $project)
                                       <tr>
                                           <td>
                                               <span class="text-dark">
                                                   {{$project->name}}
                                               </span>
                                           </td>
                                           <td>
                                               <span class="text-dark">
                                                   {{$project->description}}
                                               </span>
                                           </td>
                                           <td>
                                               @if($project->is_active == 1)
                                                   <span class="badge bg-soft-success text-success">
                                                      Sim
                                                   </span>
                                               @else
                                                   <span class="badge bg-soft-danger text-danger">
                                                      Não
                                                   </span>
                                               @endif

                                           </td>
                                           <td>
                                               <span class="text-dark">
                                                   {{$project->created_at}}
                                               </span>
                                           </td>
                                           <td>
                                               <div class="d-flex">
                                                   <a href="" class="btn btn-primary p-2 m-1">
                                                        Editar
                                                   </a>
                                                   <a class="btn btn-md bg-soft-danger text-danger p-2 m-1">
                                                       Excluir
                                                   </a>
                                                   <a class="btn btn-light-brand p-2 m-1">
                                                       Ver atividades
                                                   </a>
                                               </div>
                                           </td>
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
    </div>
</x-app-layout>
