<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/VigenereCipher', 'VigenereCipher::index');
$routes->post('/VigenereCipher/encryptvigenerecipher', 'VigenereCipher::encryptvigenerecipher');
$routes->post('/VigenereCipher/decryptvigenerecipher', 'VigenereCipher::decryptvigenerecipher');
$routes->get('/PlayfairCipher', 'PlayfairCipher::index');
$routes->post('/PlayfairCipher/encryptPlayfairCipherfile', 'PlayfairCipher::encryptPlayfairCipherfile');
$routes->post('/PlayfairCipher/encryptPlayfairCipher', 'PlayfairCipher::encryptPlayfairCipher');
$routes->post('/PlayfairCipher/decryptPlayfairCipher', 'PlayfairCipher::decryptPlayfairCipher');
$routes->get('/ProductCipher', 'ProductCipher::index');
$routes->post('/ProductCipher/encryptProductCipher', 'ProductCipher::encryptProductCipher');
$routes->post('/ProductCipher/decryptProductCipher', 'ProductCipher::decryptProductCipher');
$routes->get('download/file/(:any)', 'Download::file/$1');
$routes->get('upload', 'Upload::index');
$routes->post('upload/doUpload', 'Upload::doUpload');

