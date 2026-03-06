<div class="mb-5">

    <!-- Notification flash -->

    @if (session()->has('success'))
        <div id="alert-success" 
            class="alert alert-success fade show text-center shadow-lg"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('danger'))
        <div id="alert-success" 
            class="alert alert-danger fade show text-center shadow-lg"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('danger') }}
        </div>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-cogs"></i>
            Execute dotation/进行配给
        </h1>
        <div class="d-none d-sm-inline-block shadow-sm">
            <input wire:model.live="search" class="form-control" type="text" placeholder="Rechercher/搜索...">
        </div>
    </div>

    <!-- Table -->
    <div class="card-body">
        <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" >
                    <thead style="background-color: rgb(16, 2, 66);" class="text-white">
                        <tr>
                            <th>n</th>
                            <th>Profil/头像</th>
                            <th>Name/姓名</th>
                            <th>Matricule/工号</th>
                            <th>Function/职位</th>
                            <th>Site/站点</th>
                            <th>Actions/操作</th>
                        </tr>
                    </thead>
                    <tbody >
                        @forelse ($dotation as $dotations)
                            <tr >
                                <td>
                                    {{ ($dotation->currentPage() - 1) * $dotation->perPage() + $loop->iteration }}
                                </td>
                                <td>
                                    <img width="70px" height="70px" src="{{ asset('storage/' . $dotations?->ownerPassport) }}" alt="Photo de l'employé">
                                </td>
                                <td>{{$dotations?->middleName}} {{$dotations?->lastName}} {{$dotations?->firstName}}</td>
                                <td>{{$dotations?->matricule}}</td>
                                <td>{{$dotations?->functionType?->nameFunction}}</td>
                                <td>{{$dotations?->site?->nameSite}}</td>
                                <td>
                                    <button 
                                        wire:click="executeDotation({{ $dotations->executeDotation->id }})" 
                                        wire:confirm="Êtes-vous sûr de vouloir exécuter cette dotation ?"
                                        class="btn text-white" 
                                        style="background-color: rgb(0, 110, 28)">
                                        Execute/发放配给
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-danger">Oups! No result fund here./哎呀！这里什么也没找到</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $dotation->links() }}
            </div>
    </div>
</div>
