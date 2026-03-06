<div>
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
        <div class="alert alert-danger fade show text-center shadow-lg"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('danger') }}
        </div>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-users"></i>
            Agent Management / 代理管理 - <small class="text-muted">Step / 步骤 {{ $step }}/{{$totalSteps}}</small>
        </h1>
        <div>
            <a href="{{ route('enrollment.index')}}" style="background-color: rgb(46, 13, 167);" class="btn text-white">
                View List / 查看列表
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="progress mb-4" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: {{ ($step/$totalSteps)*100 }}%; background-color: rgb(46, 13, 167);"></div>
            </div>

            <form wire:submit.prevent="{{ $step == 3 ? 'saveEmployee' : 'nextStep' }}">
                <div class="container">
                    
                    {{-- STEP 1 : BASIC INFORMATION --}}
                    @if($step == 1)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Last Name / 姓</label>
                                <input autofocus wire:model="middleName" class="form-control mb-2" type="text">
                                @error('middleName') <span class="text-danger small">Only letters and (-) allowed / 仅限字母和 (-)</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Middle Name / 名</label>
                                <input wire:model="lastName" class="form-control mb-2" type="text">
                                @error('lastName') <span class="text-danger small">Only letters and (-) allowed / 仅限字母和 (-)</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>First Name / 名</label>
                                <input wire:model="firstName" class="form-control mb-2" type="text">
                                @error('firstName') <span class="text-danger small">Only letters and (-) allowed / 仅限字母和 (-)</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Gender / 性别</label>
                                <select wire:model="gender" class="form-control mb-2">
                                    <option>Select / 选择...</option>
                                    @foreach ($this->gender() as $g) 
                                        <option value="{{ $g }}">{{ $g }}</option> 
                                    @endforeach
                                </select>
                                @error('gender') <span class="text-danger small">Please select a value / 请选择一个值</span> @enderror
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
                                @error('birthPlace') <span class="text-danger small">Invalid format / 格式无效</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Marital Status / 婚姻状况</label>
                                <select wire:model="civilState" class="form-control mb-2">
                                    <option>Select / 选择...</option>
                                    @foreach ($this->civilState() as $g) 
                                        <option value="{{ $g }}">{{ $g }}</option> 
                                    @endforeach
                                </select>
                                @error('civilState') <span class="text-danger small">Please select a status / 请选择状态</span> @enderror
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
                                    <option>Select / 选择...</option>
                                    @foreach ($this->currentLevel() as $g) 
                                        <option value="{{ $g }}">{{ $g }}</option> 
                                    @endforeach
                                </select>
                                @error('studyLevel') <span class="text-danger small">Please select a level / 请选择程度</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Faculty / 学院</label>
                                <input wire:model="faculty" class="form-control mb-2" type="text">
                                @error('faculty') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Graduation Year / 毕业年份</label>
                                <input 
                                    wire:model="obtainingDate" 
                                    class="form-control mb-2" 
                                    type="number" 
                                    min="1900" 
                                    {{-- max="{{ date('Y') }}"  --}}
                                    placeholder="YYYY">
                                @error('obtainingYear') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Other Field / 其他领域</label>
                                <input wire:model="otherProfession" class="form-control mb-2" type="text">
                                @error('otherProfession') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>National ID Number (NN) / 国民身分证号码</label>
                                <input wire:model="nationalNumber" class="form-control mb-2" type="text">
                                @error('nationalNumber') <span class="text-danger small">Verify the number / 请核实号码</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Previous Work / 过往工作经验</label>
                                <input wire:model="lastJob" class="form-control mb-2" type="text">
                                @error('lastJob') <span class="text-danger small">Required / 必填</span> @enderror
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
                                    @forelse ($allFunctionTypes as $functions)
                                        <option value="{{ $functions?->id }}">{{ $functions?->nameFunction }}</option>
                                    @empty
                                        <option value="" disabled>No data / 无数据</option>
                                    @endforelse
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
                                    @forelse ($allSite as $site)
                                        <option value="{{ $site?->id }}">{{ $site?->nameSite }}</option>
                                    @empty
                                        <option value="" disabled>No data / 无数据</option>
                                    @endforelse
                                </select>
                                @error('site_id') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Medical History / 健康记录</label>
                                <input wire:model="desseaseHistory" class="form-control mb-2" type="text">
                                @error('desseaseHistory') <span class="text-danger small">Required / 必填</span> @enderror
                            </div>
                            <div class="mb-1">
                                <label>Passport Photo / 护照照片</label>
                                @if ($ownerPassport)
                                    <img src="{{ $ownerPassport->temporaryUrl() }}" style="width: 50px;" class="mb-2 d-block">
                                @endif
                                <input class="form-control mb-2" type="file" wire:model="ownerPassport">
                                @error('ownerPassport') <span class="text-danger small">File required / 需上传文件</span> @enderror
                            </div>
                            <div class="mb-1">
                                <label>ID Card Copy (NN) / 身分证复印件</label>
                                @if ($copyNationalCard)
                                    <img src="{{ $copyNationalCard->temporaryUrl() }}" style="width: 50px;" class="mb-2 d-block">
                                @endif
                                <input class="form-control mb-2" type="file" wire:model="copyNationalCard">
                                @error('copyNationalCard') <span class="text-danger small">File required / 需上传文件</span> @enderror
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- NAVIGATION BUTTONS --}}
                    <div class="d-flex justify-content-between mt-4">
                        @if($step > 1)
                            <button type="button" style="background-color: rgb(100, 117, 117);" wire:click="previousStep" class="btn text-white px-4">
                                Previous / 上一步
                            </button>
                        @else
                            <div></div>
                        @endif

                        @if($step < 3)
                            <button type="submit" style="background-color: rgb(46, 13, 167);" class="btn text-white px-4">
                                Next / 下一步
                            </button>
                        @else
                            <button type="submit" style="background-color: #28a745;" class="btn text-white px-4">
                                Confirm Registration / 确认保存
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>