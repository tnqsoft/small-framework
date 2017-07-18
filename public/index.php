<?php

use Entity\Category;
use Services\Core;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Load bootstrap
require_once "../bootstrap.php";
// require 'lib/Framework/Core.php';

$request = Request::createFromGlobals();
// Our framework is now handling itself the request
$app = new Core();

$response = $app->handle($request);
$response->send();

// try {
//     // Code logic
//     $category = new Category();
//     $category->setTitle('Category 1');
//     $category->setSlug('category-1');
//     $category->setIsActive(true);
//
//     $entityManager->persist($category);
//     $entityManager->flush();
//
//     echo "Created Category with ID " . $category->getId() . "\n";
//
// } catch (\Exception $e) {
//     echo $e->getMessage();
// }
