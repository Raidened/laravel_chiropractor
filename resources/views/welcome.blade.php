@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center fw-bold" style="font-family: 'Nunito', sans-serif; color: #343a40;">Votre partenaire santé au quotidien</h1>

        <div class="row text-center py-5">
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="p-4 shadow rounded w-100" style="background-color: #f8f9fa;">
                    <h2 class="fs-4 text-primary">Accédez aux soins plus facilement</h2>
                    <p class="text-muted">Réservez des consultations vidéo ou en présentiel, et recevez des rappels pour ne jamais les manquer.</p>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="p-4 shadow rounded w-100" style="background-color: #f8f9fa;">
                    <h2 class="fs-4 text-primary">Bénéficiez de soins personnalisés</h2>
                    <p class="text-muted">Échangez avec vos soignants par message, obtenez des conseils préventifs et recevez des soins quand vous en avez besoin.</p>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="p-4 shadow rounded w-100" style="background-color: #f8f9fa;">
                    <h2 class="fs-4 text-primary">Gérez votre santé</h2>
                    <p class="text-muted">Rassemblez facilement toutes vos informations de santé et celles de ceux qui comptent pour vous.</p>
                </div>
            </div>
        </div>

        <div class="text-center bg-light py-4 rounded shadow mx-auto" style="max-width: 700px;">
            <h3 class="fw-bold text-dark">SantéMouv en chiffres</h3>
            <p class="fs-5 text-secondary">80 millions de personnes mieux soignées</p>
            <p class="fs-5 text-secondary">410 000 soignants utilisant Doctolib</p>
            <p class="fs-5 text-secondary">7 millions de documents partagés chaque mois</p>
        </div>

        <div class="text-center bg-light py-4 rounded shadow mt-5 mx-auto" style="max-width: 700px;">
            <h3 class="fw-bold text-dark">Vous êtes soignant ?</h3>
            <p class="fs-5">Découvrez SantéMouv pour les soignants et améliorez votre quotidien</p>
            <ul class="list-unstyled">
                <li>✔ Dispensez les meilleurs soins possibles à vos patients</li>
                <li>✔ Profitez d'une meilleure qualité de vie au travail</li>
                <li>✔ Augmentez les revenus de votre activité</li>
                <li>✔ Adoptez les solutions utilisées par plus de 410 000 soignants en Europe</li>
            </ul>
        </div>

    </div>
@endsection
