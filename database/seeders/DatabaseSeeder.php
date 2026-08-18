<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\ContactMessage;
use App\Models\PedagogicalDocument;
use App\Models\Progression;
use App\Models\Reservation;
use App\Models\Session;
use App\Models\Tag;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Création des utilisateurs (Administratrice + Membres)
        $admin = User::create([
            'name' => 'Administratrice Ô Fil du Temps',
            'email' => 'admin@oft-atelier.fr',
            'password' => bcrypt('Password123!'),
            'role' => 'admin',
        ]);

        $member1 = User::create([
            'name' => 'Marie Dupont',
            'email' => 'marie@example.com',
            'password' => bcrypt('Password123!'),
            'role' => 'member',
        ]);

        $member2 = User::create([
            'name' => 'Sophie Martin',
            'email' => 'sophie@example.com',
            'password' => bcrypt('Password123!'),
            'role' => 'member',
        ]);

        // 2. Création des Catégories
        $categories = [
            ['name' => 'Couture Débutant', 'slug' => 'couture-debutant'],
            ['name' => 'Patronage & Modélisme', 'slug' => 'patronage-modelisme'],
            ['name' => 'Retouches & Transformation', 'slug' => 'retouches-transformation'],
            ['name' => 'Techniques Artisanales', 'slug' => 'techniques-artisanales'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // 3. Création des Tags
        $tagsData = ['Initiation', 'Perfectionnement', 'Machine à coudre', 'Broderie', 'Zero Déchet'];
        $tags = [];
        foreach ($tagsData as $tagName) {
            $tags[] = Tag::create([
                'name' => $tagName,
                'slug' => Str::slug($tagName),
            ]);
        }

        // 4. Création des Formations
        $training1 = Training::create([
            'title' => 'Prise en main de la machine à coudre',
            'slug' => 'prise-en-main-machine-a-coudre',
            'description' => 'Apprenez à enfiler votre machine, réaliser vos premières coutures droites et entretenir votre matériel.',
            'objectives' => 'Enfilage, réglage de la tension, coutures de base, réalisation d\'un tote bag.',
            'duration' => 180, // 3 heures
            'price' => 45.00,
            'category_id' => 1,
        ]);
        $training1->tags()->attach([$tags[0]->id, $tags[2]->id]);

        $training2 = Training::create([
            'title' => 'Création d\'un patron de jupe sur-mesure',
            'slug' => 'creation-patron-jupe-sur-mesure',
            'description' => 'Apprenez à prendre vos mesures et concevoir le patron de base d\'une jupe droite.',
            'objectives' => 'Prise de mesures, tracé du patron de base, ajustements et modifications.',
            'duration' => 240, // 4 heures
            'price' => 65.00,
            'category_id' => 2,
        ]);
        $training2->tags()->attach([$tags[1]->id]);

        // 5. Création des Séances de Formation (training_sessions)
        $session1 = Session::create([
            'training_id' => $training1->id,
            'date' => now()->addDays(5)->format('Y-m-d'),
            'start_time' => '14:00:00',
            'capacity' => 6,
            'status' => 'open',
        ]);

        $session2 = Session::create([
            'training_id' => $training2->id,
            'date' => now()->addDays(10)->format('Y-m-d'),
            'start_time' => '09:30:00',
            'capacity' => 4,
            'status' => 'open',
        ]);

        // 6. Création des Réservations
        Reservation::create([
            'user_id' => $member1->id,
            'training_session_id' => $session1->id,
            'status' => 'confirmed',
        ]);

        Reservation::create([
            'user_id' => $member2->id,
            'training_session_id' => $session1->id,
            'status' => 'pending',
        ]);

        // 7. Documents Pédagogiques
        PedagogicalDocument::create([
            'training_id' => $training1->id,
            'title' => 'Guide d\'enfilage et réglages de base',
            'file_path' => 'documents/guide_machine.pdf',
        ]);

        // 8. Suivi Pédagogique
        Progression::create([
            'user_id' => $member1->id,
            'training_id' => $training1->id,
            'percentage' => 50,
            'notes' => 'Excellente maîtrise du tracé, attention à la tension du fil.',
        ]);

        // 9. Commentaires & Avis
        Comment::create([
            'user_id' => $member1->id,
            'training_id' => $training1->id,
            'content' => 'Atelier très pédagogique et ambiance très chaleureuse ! Je recommande vivement.',
            'is_approved' => true,
        ]);

        // 10. Messages de Contact
        ContactMessage::create([
            'name' => 'Claire Valois',
            'email' => 'claire@example.com',
            'subject' => 'Renseignements sur les ateliers enfants',
            'message' => 'Bonjour, proposez-vous des stages pendant les vacances scolaires ? Merci.',
            'status' => 'new',
        ]);
    }
}
