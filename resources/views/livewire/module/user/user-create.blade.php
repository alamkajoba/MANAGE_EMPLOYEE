<div>
<!-- notify -->
     @if (session()->has('success'))
        <div id="alert-success" 
            class="alert alert-success fade show text-center"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('success') }}
        </div>
    @endif
     @if (session()->has('danger'))
        <div id="alert-danger" 
            class="alert alert-danger fade show text-center"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('danger') }}
        </div>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ajouter un utilisateur</h1>
        <a href="{{route('user.index')}}" style="background-color: rgb(16, 2, 66);" class="btn text-white">
            Voir la liste
        </a>
    </div>



    <div class="justify-content-between card-header">
        <form wire:submit="submitUser()">
            @csrf
            
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Name</label>
                        <input 
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="name"
                        >
                        <label for="">Identifiant de connexion</label>
                        <input 
                            class="form-control"
                            type="email"
                            placeholder=""
                            wire:model="email"
                        >
                        @error('email')
                            <div style="color: rgb(252, 0, 0)" class="flex"> 
                                saisissez plus de 3 caracteres
                            </div> 
                        @enderror
                        
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
        
