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

    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-cogs"></i>
            Employees' list/员工列表
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
                            <th colspan="4">Actions/操作</th>
                        </tr>
                    </thead>
                    <tbody >
                        @forelse ($enrollment as $enrollments)
                            <tr >
                                <td>
                                    {{ ($enrollment->currentPage() - 1) * $enrollment->perPage() + $loop->iteration }}
                                </td>
                                <td>
                                    <img width="70px" height="70px" src="{{ asset('storage/' . $enrollments->ownerPassport) }}" alt="Photo de l'employé">
                                </td>
                                <td>{{$enrollments->middleName}}  {{$enrollments->lastName}}  {{$enrollments->firstName}}</td>
                                <td>{{$enrollments->matricule}}</td>
                                <td>{{$enrollments->functionType?->nameFunction}}</td>
                                <td>{{$enrollments->site?->nameSite}}</td>
                                <td>
                                    <a href="{{route('enrollment.detail', $enrollments->id)}}" class="btn text-white" style="background-color: rgb(0, 110, 28)">
                                        File
                                    </a>
                                </td>
                                {{-- <td>
                                    <a href="" class="btn text-white" style="background-color: rgb(16, 2, 66);">
                                        ID
                                    </a>
                                </td> --}}
                                @can('EditEmployee')
                                    <td>
                                        <a href="{{route('enrollment.update', $enrollments->id)}}" class="btn text-white" style="background-color: rgb(158, 155, 155)">
                                            Edit
                                        </a>
                                    </td>
                                @endcan
                                @can('DisableEmployee')
                                    <td>
                                        <button 
                                            class="btn text-white" 
                                            style="background-color: rgb(16, 2, 66)"
                                            wire:click="enableEmployee({{ $enrollments->id }})"
                                            wire:confirm="Are you sure you want to enable this agent? / 启用 ？"
                                            >
                                            Enable
                                        </button>
                                    </td>
                                @endcan
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
                {{ $enrollment->links() }}
            </div>
    </div>
</div>
