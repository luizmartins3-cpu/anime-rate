<?php

require __DIR__ . '/../core/Database.php';

use Core\Database;

$db = Database::getInstance()->getConnection();

// Criar tabelas
$schema = file_get_contents(__DIR__ . '/schema.sql');
$db->exec($schema);

echo "Tabelas criadas com sucesso!\n";

// Seed data (simplificado para demonstração)
$animes = [
    [
        'name' => 'Naruto Shippuden',
        'image' => 'images/naruto.png',
        'rating' => 8.7,
        'description' => 'Naruto Uzumaki quer se tornar o maior ninja da vila.',
        'full_description' => 'Naruto Shippuden é a continuação da série original Naruto e segue o jovem ninja Naruto Uzumaki em sua jornada para se tornar o Hokage.',
        'episodes' => 500,
        'seasons' => 21,
        'trailer' => 'https://www.youtube.com/embed/1y_Xp26p0Sg'
    ],
    [
        'name' => 'One Piece',
        'image' => 'https://media.kitsu.app/anime/poster_images/12/large.jpg',
        'rating' => 8.9,
        'description' => 'Luffy e sua tripulação buscam o tesouro supremo.',
        'full_description' => 'Monkey D. Luffy recusa-se a deixar que qualquer coisa o impeça de se tornar o rei de todos os piratas.',
        'episodes' => 1100,
        'seasons' => 20,
        'trailer' => 'https://www.youtube.com/embed/S8_YwFLCh4U'
    ],
    [
        'name' => 'Attack on Titan',
        'image' => 'https://media.kitsu.app/anime/poster_images/7442/large.jpg',
        'rating' => 9.1,
        'description' => 'A humanidade luta contra gigantes comedores de gente.',
        'full_description' => 'Depois que sua cidade natal é destruída e sua mãe é morta, o jovem Eren Jaeger jura limpar a terra dos gigantes Titãs.',
        'episodes' => 88,
        'seasons' => 4,
        'trailer' => 'https://www.youtube.com/embed/MGRm4IzK1SQ'
    ],
    [
        'name' => 'Bocchi the Rock!',
        'image' => 'images/bocchi.jpg',
        'rating' => 8.6,
        'description' => 'Uma garota ansiosa entra em uma banda de rock.',
        'full_description' => 'Hitori Gotou é uma estudante do ensino médio que começa a aprender a tocar violão porque sonha em estar em uma banda, mas ela é tão tímida que não fez um único amigo.',
        'episodes' => 12,
        'seasons' => 1,
        'trailer' => 'https://www.youtube.com/embed/5U7Z0sYvA2Y'
    ],
    [
        'name' => 'Frieren: Beyond Journey\'s End',
        'image' => 'images/frieren.jpg',
        'rating' => 9.1,
        'description' => 'Uma maga elfa reflete sobre a vida e a mortalidade.',
        'full_description' => 'A maga elfa Frieren e seus corajosos companheiros aventureiros derrotaram o Rei Demônio e trouxeram a paz à terra.',
        'episodes' => 28,
        'seasons' => 1,
        'trailer' => 'https://www.youtube.com/embed/qSHeXvY_v2M'
    ]
];

foreach ($animes as $anime) {
    $stmt = $db->prepare("INSERT INTO animes (name, image, rating, description, full_description, episodes, seasons, trailer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$anime['name'], $anime['image'], $anime['rating'], $anime['description'], $anime['full_description'], $anime['episodes'], $anime['seasons'], $anime['trailer']]);
}

echo "Dados iniciais inseridos com sucesso!\n";
