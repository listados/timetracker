<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">{{ __('Dashboard') }}</h2>
    </x-slot>
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">{{$activity[0]->project->name}}</h5>
                        <div class="card-header-action">
                            <div class="card-header-btn">
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#createActivity" class="btn btn-primary btn-sm me-3">
                                    <i class="feather-plus me-2"></i>
                                    Nova Atividade
                                </a>
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
                                            {{ $activities->started_at?->format('d/m/Y H:i') }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ $activities->ended_at?->format('d/m/Y H:i') }}
                                    </td>
                                    <td>
                                        {{$activities->humanized_duration}}
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="javascript:void(0);"
                                               data-bs-toggle="modal" data-bs-target="#editActivity-{{$activities->id}}"
                                               title="editar" class="avatar-text avatar-md">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);"
                                               data-bs-toggle="modal" data-bs-target="#deleteActivity-{{$activities->id}}"
                                               title="Excluir" class="avatar-text avatar-md text-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                    @push('modals')
                                        {{-- Modal de Edição --}}
                                        <div class="modal fade" id="editActivity-{{$activities->id}}" tabindex="-1" aria-labelledby="editModalLabel-{{$activities->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar Atividade</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('atividades.update', $activities->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label">Título:</label>
                                                                    <input type="text" name="title" value="{{ $activities->title }}" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label">Descrição:</label>
                                                                    <textarea name="description" class="form-control" rows="3">{{ $activities->description }}</textarea>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Iniciado em:</label>
                                                                    <input type="datetime-local" name="started_at" value="{{ date('Y-m-d\TH:i', strtotime($activities->started_at)) }}" class="form-control">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Finalizado em:</label>
                                                                    <input type="datetime-local" name="ended_at" value="{{ $activities->ended_at ? date('Y-m-d\TH:i', strtotime($activities->ended_at)) : '' }}" class="form-control">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Link GitHub:</label>
                                                                    <input type="url" name="github_link" value="{{ $activities->github_link }}" class="form-control" placeholder="https://github.com/...">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Link Todoist:</label>
                                                                    <input type="url" name="todoist_link" value="{{ $activities->todoist_link }}" class="form-control" placeholder="https://todoist.com/...">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer px-0 pb-0">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Modal de Confirmação de Exclusão --}}
                                        <div class="modal fade" id="deleteActivity-{{$activities->id}}" tabindex="-1" aria-labelledby="deleteModalLabel-{{$activities->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmar Exclusão</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Tem certeza que deseja excluir a atividade: <strong>{{ $activities->title }}</strong>?</p>
                                                        <p class="text-muted small">Esta ação não poderar ser desfeita posteriormente.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('atividades.destroy', $activities->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                                                        </form>
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

    {{-- Modal de Criação --}}
    @push('modals')
        <div class="modal fade" id="createActivity" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova Atividade</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('atividades.store', $activity[0]->project_id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Título:</label>
                                    <input type="text" name="title" class="form-control"
                                           placeholder="O que você vai fazer?"
                                    >
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Descrição:</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Detalhes opcionais..."></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Iniciado em:</label>
                                    <input type="datetime-local" name="started_at" value="{{ date('Y-m-d\TH:i') }}" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Finalizado em:</label>
                                    <input type="datetime-local" name="ended_at" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Link GitHub:</label>
                                    <input type="url" name="github_link" class="form-control" placeholder="https://github.com/...">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Link Todoist:</label>
                                    <input type="url" name="todoist_link" class="form-control" placeholder="https://todoist.com/...">
                                </div>
                            </div>
                            <div class="modal-footer px-0 pb-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Criar Atividade</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush
</x-app-layout>
