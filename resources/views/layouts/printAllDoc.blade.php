<!DOCTYPE html>
<html lang="fr">
{{-- HEADER --}}
    @include('partials.header')

<style>
        /* Configuration de la page A4 */
        @page {
            size: A4;
            margin: 10mm; /* Marges physiques de l'imprimante */
        }
        .toolbar {
            display: flex;
            justify-content: space-between; /* Espace maximum entre les deux */
            width: 190mm; /* Aligné sur la largeur du formulaire */
            margin: 10px auto;
            padding: 10px 0;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-family: Arial, sans-serif;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-back {
            background-color: #f2f2f2;
            color: #333;
            border: 1px solid #ccc;
        }

        .btn-back:hover {
            background-color: #e0e0e0;
        }

        .btn-print {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-print:hover {
            background-color: #0056b3;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px; /* Légèrement augmenté pour la lisibilité */
            color: #000;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        /* Conteneur principal simulant le A4 */
        .form-container {
            width: 190mm; /* Largeur A4 (210mm) - marges (20mm) */
            margin: 0 auto;
            border: 2px solid #000;
            padding: 5mm;
            box-sizing: border-box;
            min-height: 270mm; /* Hauteur quasi-totale pour remplir la page */
            display: flex;
            flex-direction: column;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h1 { margin: 0; font-size: 22px; text-transform: uppercase; }
        .header h2 { margin: 5px 0; font-size: 16px; font-weight: normal; font-style: italic; }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Indispensable pour respecter les largeurs % */
            flex-grow: 1; /* Permet au tableau de s'étirer si besoin */
        }

        th, td {
            border: 1px solid #000;
            padding: 10px 8px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        /* Colonnes de titres */
        .section-title {
            font-weight: bold;
            background-color: #f2f2f2 !important; /* !important pour l'impression */
            text-align: center;
            width: 15%;
            -webkit-print-color-adjust: exact; /* Force la couleur au print */
        }

        .label {
            background-color: #f9f9f9 !important;
            font-weight: bold;
            text-align: center;
            width: 20%;
            -webkit-print-color-adjust: exact;
        }

        .value {
            text-align: left;
            padding-left: 10px;
            font-weight: normal;
        }

        /* Photos ajustées pour l'espace restant */
        .photo-container {
            height: 200px;
            text-align: center;
        }

        .photo-placeholder {
            height: 200px;
            width: 200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            font-size: 10px;
        }

        .page-break {
            page-break-after: always;
            break-after: page;
        }
        /* Cacher les éléments inutiles à l'impression si besoin (boutons, etc) */
        @media print {
            .no-print { display: none; }
            body { -webkit-print-color-adjust: exact; }
        }
    </style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        {{-- SIDEBAR --}}
        @include('partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            {{-- TOPBAR --}}
            @include('partials.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                       {{ $slot ?? '' }}
                    </main>

                </div>
            </div>
            {{-- FOOTER --}}
            @include('partials.footer')

        </div>
        <!-- End of Content Wrapper -->
    </div>
    {{-- SCRIPTFOOTER --}}
    @include('partials.scriptfooter')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
    @stack('scripts')

        <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('alert-success');
            if (alert) {
                setTimeout(() => {
                    alert.classList.remove('show'); // commence la disparition
                    setTimeout(() => {
                        alert.remove(); // supprime du DOM après l'animation
                    }, 500); // temps pour le fade-out
                }, 5000); // affichée pendant 3 secondes
            }
        });
    </script>
</body>

</html>