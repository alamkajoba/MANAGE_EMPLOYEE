<div class="container">
    <button class="no-print" onclick="window.print()">Imprimer 🖨️</button>

    <table class="classic-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full name</th>
                <th>Gender</th>
                <th>Function</th>
                <th>Start Date</th>
                <th>BirthDate</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($print as $prints)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$prints->middleName}} {{$prints->lastName}} {{$prints->firstName}}</td>
                    <td>{{$prints->gender}}</td>
                    <td>{{$prints->functionType->nameFunction}}</td>
                    <td>{{$prints->startDate->format('Y-m-d')}}</td>
                    <td>{{$prints->birthDate->format('Y-m-d')}}</td>
                    <td>oui</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>