<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-cogs"></i>
            Sites/站点
        </h1>
        <div>
            <a href="{{ route('site.index')}}" style="background-color: rgb(16, 2, 66);" class="btn text-white">Voir la liste</a>
        </div>
    </div>

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
    
    {{-- table --}}
    <div class="justify-content-between card-header">
        <form wire:submit="submitSite">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-1">
                            <label for="nameSite">Site/站点</label>
                            <input 
                                id="nameSite"
                                class="form-control"
                                type="text"
                                placeholder="ex:TFM"
                                wire:model="nameSite"
                                autofocus
                            >
                            @error('nameSite')
                                <span style="color: rgb(252, 0, 0)" class="flex">Ce champs ne doit pas être vide</span>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label for="department">Description/描述</label>
                            <input 
                                id="description"
                                class="form-control"
                                type="text"
                                placeholder=""
                                wire:model="description"
                            >
                            @error('description')
                                <span style="color: rgb(252, 0, 0)" class="flex">Ce champs ne doit pas être vide</span>
                            @enderror
                        </div>
                        
                        
                        
                    </div>

                    <div class="col-md-6">
        
                        
                    </div>
                </div>
                <div>
                    <button type="submit" style="background-color: rgb(16, 2, 66);" class="btn text-white py-2 my-3">
                        Valider
                    </button>
                </div>
            </div>
        </form>
    </div>  
</div>