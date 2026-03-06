<div>
    {{-- Notifications Flash --}}
    @if (session()->has('success'))
        <div id="alert-success" 
            class="alert alert-success fade show text-center shadow-lg"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    @if (session()->has('danger'))
        <div class="alert alert-danger fade show text-center shadow-lg"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('danger') }}
        </div>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-user-edit"></i>
            Edit Agent / 编辑代理 - <small class="text-muted">Step {{ $step }}/{{$totalSteps}}</small>
        </h1>
        <div>
            <a href="{{ route('enrollment.index')}}" style="background-color: rgb(46, 13, 167);" class="btn text-white">
                <i class="fas fa-list mr-1"></i> View List / 查看列表
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            {{-- Barre de progression --}}
            <div class="progress mb-4" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: {{ ($step/$totalSteps)*100 }}%; background-color: rgb(46, 13, 167);"></div>
            </div>

            {{-- Formulaire --}}
            <form wire:submit.prevent="{{ $step == 3 ? 'updateEmployee' : 'nextStep' }}">
                <div class="container">
                    
                    {{-- STEP 1 : BASIC INFORMATION --}}
                    @if($step == 1)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Last Name / 姓</label>
                                <input autofocus wire:model="middleName" class="form-control mb-2" type="text">
                                @error('middleName') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Middle Name / 名</label>
                                <input wire:model="lastName" class="form-control mb-2" type="text">
                                @error('lastName') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>First Name / 名</label>
                                <input wire:model="firstName" class="form-control mb-2" type="text">
                                @error('firstName') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Gender / 性别</label>
                                <select wire:model="gender" class="form-control mb-2">
                                    <option value="">Select / 选择...</option>
                                    @foreach ($genders as $g) 
                                        <option value="{{ $g->value }}">{{ $g->name }}</option> 
                                    @endforeach
                                </select>
                                @error('gender') <span class="text-danger small">Select gender / 请选择性别</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Date of Birth / 出生日期</label>
                                <input wire:model="birthDate" class="form-control mb-2" type="date">
                                @error('birthDate') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>
                            
                            <div class="mb-1">
                                <label>Place of Birth / 出生地点</label>
                                <input wire:model="birthPlace" class="form-control mb-2" type="text">
                                @error('birthPlace') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Marital Status / 婚姻状况</label>
                                <select wire:model="civilState" class="form-control mb-2">
                                    <option value="">Select / 选择...</option>
                                    @foreach ($states as $state) 
                                        <option value="{{ $state->value }}">{{ $state->name }}</option> 
                                    @endforeach
                                </select>
                                @error('civilState') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Nationality / 国籍</label>
                                <input wire:model="nationality" class="form-control mb-2" type="text">
                                @error('nationality') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Address / 地址</label>
                                <input wire:model="address" class="form-control mb-2" type="text">
                                @error('address') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- STEP 2 : EDUCATION AND PREVIOUS EXP --}}
                    @if($step == 2)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Phone / 电话</label>
                                <input wire:model="phone" class="form-control mb-2" type="text">
                                @error('phone') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Education Level / 教育程度</label>
                                <select wire:model="studyLevel" class="form-control mb-2">
                                    <option value="">Select / 选择...</option>
                                    @foreach ($levels as $level) 
                                        <option value="{{ $level->value }}">{{ $level->name }}</option> 
                                    @endforeach
                                </select>
                                @error('studyLevel') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Faculty / 学院</label>
                                <input wire:model="faculty" class="form-control mb-2" type="text">
                                @error('faculty') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Graduation Year / 毕业年份</label>
                                <input wire:model="obtainingDate" class="form-control mb-2" type="number" placeholder="YYYY">
                                @error('obtainingDate') <span class="text-danger small">Invalid / 无效</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Other Field / 其他领域</label>
                                <input wire:model="otherProfession" class="form-control mb-2" type="text">
                            </div>

                            <div class="mb-1">
                                <label>National ID Number (NN) / 国民身分证号码</label>
                                <input wire:model="nationalNumber" class="form-control mb-2" type="text">
                            </div>

                            <div class="mb-1">
                                <label>Previous Work / 过往工作经验</label>
                                <input wire:model="lastJob" class="form-control mb-2" type="text">
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- STEP 3 : PROFESSIONAL INFO & DOCUMENTS --}}
                    @if($step == 3)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Position / 职位</label>
                                <select wire:model="function_type_id" class="form-control mb-2">
                                    <option value="">Select / 选择...</option>
                                    @foreach ($allFunctionTypes as $functions)
                                        <option value="{{ $functions->id }}">{{ $functions->nameFunction }}</option>
                                    @endforeach
                                </select>
                                @error('function_type_id') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Contract Start Date / 合同开始日期</label>
                                <input wire:model="startDate" class="form-control mb-2" type="date">
                                @error('startDate') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Site / 站点 (部门)</label>
                                <select wire:model="site_id" class="form-control mb-2">
                                    <option value="">Select / 选择...</option>
                                    @foreach ($allSite as $site)
                                        <option value="{{ $site->id }}">{{ $site->nameSite }}</option>
                                    @endforeach
                                </select>
                                @error('site_id') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Medical History / 健康记录</label>
                                <input wire:model="desseaseHistory" class="form-control mb-2" type="text">
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- Passport Section --}}
                            <div class="mb-3">
                                <label class="font-weight-bold">Passport Photo / 护照照片</label>
                                <div class="mb-2">
                                    @if ($ownerPassport)
                                        <img src="{{ $ownerPassport->temporaryUrl() }}" style="width: 100px; height: 100px; object-fit: cover;" class="rounded shadow-sm border border-success">
                                        <small class="text-success d-block">Preview New Image</small>
                                    @elseif ($oldPassport)
                                        <img src="{{ asset('storage/' . $oldPassport) }}" style="width: 100px; height: 100px; object-fit: cover;" class="rounded shadow-sm border">
                                        <small class="text-muted d-block">Current Image</small>
                                    @endif
                                </div>
                                <input class="form-control-file" type="file" wire:model="ownerPassport">
                                <div wire:loading wire:target="ownerPassport" class="text-primary small">Uploading...</div>
                                @error('ownerPassport') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            {{-- ID Card Section --}}
                            <div class="mb-3">
                                <label class="font-weight-bold">ID Card Copy (NN) / 身分证复印件</label>
                                <div class="mb-2">
                                    @if ($copyNationalCard)
                                        <img src="{{ $copyNationalCard->temporaryUrl() }}" style="width: 100px; height: 100px; object-fit: cover;" class="rounded shadow-sm border border-success">
                                        <small class="text-success d-block">Preview New Document</small>
                                    @elseif ($oldNationalCard)
                                        <img src="{{ asset('storage/' . $oldNationalCard) }}" style="width: 100px; height: 100px; object-fit: cover;" class="rounded shadow-sm border">
                                        <small class="text-muted d-block">Current Document</small>
                                    @endif
                                </div>
                                <input class="form-control-file" type="file" wire:model="copyNationalCard">
                                <div wire:loading wire:target="copyNationalCard" class="text-primary small">Uploading...</div>
                                @error('copyNationalCard') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- NAVIGATION BUTTONS --}}
                    <div class="d-flex justify-content-between mt-4">
                        @if($step > 1)
                            <button type="button" style="background-color: rgb(100, 117, 117);" wire:click="previousStep" class="btn text-white px-4">
                                <i class="fas fa-arrow-left"></i> Previous / 上一步
                            </button>
                        @else
                            <div></div>
                        @endif

                        @if($step < 3)
                            <button type="submit" style="background-color: rgb(46, 13, 167);" class="btn text-white px-4">
                                Next / 下一步 <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        @else
                            <button type="submit" style="background-color: #28a745;" class="btn text-white px-4 font-weight-bold shadow">
                                <i class="fas fa-save mr-1"></i> Update Agent / 确认更新
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>