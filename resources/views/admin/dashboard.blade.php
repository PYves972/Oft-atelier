<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord Admin - Ô Fil du Temps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Message de bienvenue -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 mb-6">
                <h3 class="text-lg font-bold mb-2">Bienvenue dans l'espace d'administration</h3>
                <p class="text-gray-600">Gérez vos formations, séances, réservations et contenus depuis cette interface.</p>
            </div>

            <!-- Cartes de statistiques / raccourcis -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Formations -->
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-indigo-500">
                    <div class="text-gray-500 text-sm">Formations</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $trainingsCount }}</div>
                    <a href="#" class="text-indigo-600 hover:underline text-sm mt-2 inline-block">Gérer les formations &rarr;</a>
                </div>

                <!-- Séances -->
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm">Séances programmées</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $sessionsCount }}</div>
                    <a href="#" class="text-green-600 hover:underline text-sm mt-2 inline-block">Gérer le planning &rarr;</a>
                </div>

                <!-- Réservations -->
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-500">
                    <div class="text-gray-500 text-sm">Réservations</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $reservationsCount }}</div>
                    <a href="#" class="text-yellow-600 hover:underline text-sm mt-2 inline-block">Voir les réservations &rarr;</a>
                </div>

                <!-- Utilisateurs -->
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-purple-500">
                    <div class="text-gray-500 text-sm">Membres inscrits</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $membersCount }}</div>
                    <a href="#" class="text-purple-600 hover:underline text-sm mt-2 inline-block">Voir les membres &rarr;</a>
                </div>
            </div>

            <!-- Dernières réservations enregistrées -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Dernières réservations</h3>



                @if($latestReservations->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                                    <th class="p-3">Client</th>
                                    <th class="p-3">Formation</th>
                                    <th class="p-3">Date séance</th>
                                    <th class="p-3">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y text-sm text-gray-700">
                                @foreach($latestReservations as $reservation)
                                    <tr>
                                        <td class="p-3 font-medium">{{ $reservation->user->name ?? 'N/A' }}</td>
                                        <td class="p-3">{{ $reservation->session->training->title ?? 'N/A' }}</td>
                                        <td class="p-3">{{ $reservation->session->date ?? 'N/A' }} à {{ $reservation->session->start_time ?? '' }}</td>
                                        <td class="p-3">
                                            <span class="px-2 py-1 rounded text-xs font-semibold
                                                @if($reservation->status === 'confirmed') bg-green-100 text-green-800
                                                @elseif($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Aucune réservation enregistrée pour le moment.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
