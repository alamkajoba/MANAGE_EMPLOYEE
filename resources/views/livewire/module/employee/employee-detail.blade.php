

<div>
    <div class="toolbar no-print">
        <a href="javascript:history.back()" class="btn btn-back">← Retour</a>
        <button onclick="window.print()" class="btn btn-print">Imprimer la fiche 🖨️</button>
    </div>
    <div class="form-container">
        <div class="header">
            <h1>员工信息登记表</h1>
            <h2>Formulaire d'enregistrement des informations sur les employés</h2>
        </div>

        <table>
            <tr>
                <td rowspan="5" class="section-title">基本情况<br>Informations de base</td>
                <td class="label">姓名<br>Nom</td>
                <td class="value" colspan="2">{{$enrollment->middleName}} {{$enrollment->middleName}} {{$enrollment->middleName}}</td>
                <td class="label">性别<br>Sexe</td>
                <td class="value">{{$enrollment->gender}}</td>
            </tr>
            <tr>
                <td class="label">出生日期<br>Date de naissance</td>
                <td class="value" colspan="2">{{$enrollment->birthDate->format('Y-m-d')}}</td>
                <td class="label">年龄<br>Âge</td>
                <td class="value">-</td>
            </tr>
            <tr>
                <td class="label">国籍<br>Nationalité</td>
                <td class="value" colspan="2">{{$enrollment->nationality}}</td>
                <td class="label">选民证<br>NN</td>
                <td class="value">{{$enrollment->nationalNumber}}</td>
            </tr>
            <tr>
                <td class="label">婚姻状况<br>Matrimoniale</td>
                <td class="value" colspan="2">{{$enrollment->civilState}}</td>
                <td class="label">个人手机<br>Téléphone</td>
                <td class="value">{{$enrollment->phone}}</td>
            </tr>
            <tr>
                <td class="label">居住地<br>Adresse</td>
                <td class="value" colspan="4">{{$enrollment->address}}</td>
            </tr>

            <tr>
                <td rowspan="2" class="section-title">教育背景<br>Formation</td>
                <td class="label">毕业院校<br>Ecole</td>
                <td class="value" colspan="4">{{$enrollment?->faculty}}</td>
            </tr>
            <tr>
                <td class="label">所学专业<br>Domaine d'études</td>
                <td class="value">{{$enrollment->faculty}}</td>
                <td class="label" colspan="2">毕业日期<br>Date d'obtention</td>
                <td class="value">{{$enrollment?->obtainingDate}}</td>
            </tr>

            <tr>
                <td rowspan="5" class="section-title">工作信息<br>Emploie</td>
                <td class="label">入职日期<br>Date de début</td>
                <td class="value">{{$enrollment->startDate->format('Y-m-d')}}</td>
                <td class="label" colspan="2">员工编号<br>Matricule</td>
                <td class="value">{{$enrollment->id}}</td>
            </tr>
            <tr>
                <td class="label">所属部门<br>Département</td>
                <td class="value">{{$enrollment?->site?->nameSite}}</td>
                <td class="label" colspan="2">岗位/职务<br>Poste / Fonction</td>
                <td class="value">{{$enrollment?->functionType?->nameFunction}}</td>
            </tr>
            <tr>
                <td class="label">专业技能<br>Bonne compétences</td>
                <td class="value" colspan="4">{{$enrollment?->lastJob}}</td>
            </tr>
            <tr>
                <td class="label">既往病史<br>Antécédant médical</td>
                <td class="value" colspan="4">{{$enrollment?->lastJob}}</td>
            </tr>
            <tr>
                <td class="label">工作经历<br>Expérience</td>
                <td class="value" colspan="4">{{$enrollment?->lastJob}}</td>
            </tr>

            <tr>
                <td class="section-title" rowspan="2">其他信息<br>Autres</td>
                <td class="label" colspan="2">员工照片<br>Photo de l'employé</td>
                <td class="label" colspan="3">选民证照片<br>Photo Carte d'électeur (NN)</td>
            </tr>
            <tr>
                <td colspan="2" class="photo-container">
                    <div class="photo-placeholder">
                        @if($enrollment->ownerPassport)
                            <img src="{{ asset('storage/'.$enrollment->ownerPassport) }}" alt="Photo Employé" class="photo-render" style="max-height: 180px; width: auto; object-fit: contain;">
                        @else
                            <div class="photo-placeholder">Aucune photo</div>
                        @endif
                    </div>
                </td>
                <td colspan="3" class="photo-container">
                    <div class="photo-placeholder">
                        @if($enrollment->copyNationalCard)
                            <img src="{{ asset('storage/'.$enrollment->copyNationalCard) }}" alt="Photo Employé" class="photo-render" style="max-height: 180px; width: auto; object-fit: contain;">
                        @else
                            <div class="photo-placeholder">Aucune photo</div>
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>