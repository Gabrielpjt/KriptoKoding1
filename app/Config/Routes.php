<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/VigenereCipher', 'VigenereCipher::index');
$routes->post('/VigenereCipher/encryptVigenereCipher', 'VigenereCipher::encryptvigenerecipher');
$routes->post('/VigenereCipher/decryptVigenereCipher', 'VigenereCipher::decryptvigenerecipher');
$routes->post('/VigenereCipher/encryptVigenereCipherfile', 'VigenereCipher::encryptVigenereCipherfile');
$routes->post('/VigenereCipher/decryptVigenereCipherfile', 'VigenereCipher::decryptVigenereCipherfile');

$routes->get('/ExtendedVigenereCipher', 'ExtendedVigenereCipher::index');
$routes->post('/ExtendedVigenereCipher/encryptExtendedVigenereCipher', 'ExtendedVigenereCipher::encryptextendedvigenerecipher');
$routes->post('/ExtendedVigenereCipher/decryptExtendedVigenereCipher', 'ExtendedVigenereCipher::decryptextendedvigenerecipher');
$routes->post('/ExtendedVigenereCipher/encryptExtendedVigenereCipherfile', 'ExtendedVigenereCipher::encryptExtendedVigenereCipherfile');
$routes->post('/ExtendedVigenereCipher/decryptExtendedVigenereCipherfile', 'ExtendedVigenereCipher::decryptExtendedVigenereCipherfile');

$routes->get('/PlayfairCipher', 'PlayfairCipher::index');
$routes->post('/PlayfairCipher/encryptPlayfairCipherfile', 'PlayfairCipher::encryptPlayfairCipherfile');
$routes->post('/PlayfairCipher/decryptPlayfairCipherfile', 'PlayfairCipher::decryptPlayfairCipherfile');
$routes->post('/PlayfairCipher/encryptPlayfairCipher', 'PlayfairCipher::encryptPlayfairCipher');
$routes->post('/PlayfairCipher/decryptPlayfairCipher', 'PlayfairCipher::decryptPlayfairCipher');

$routes->get('/ProductCipher', 'ProductCipher::index');
$routes->post('/ProductCipher/encryptProductCipher', 'ProductCipher::encryptProductCipher');
$routes->post('/ProductCipher/decryptProductCipher', 'ProductCipher::decryptProductCipher');
$routes->post('/ProductCipher/encryptProductCipherfile', 'ProductCipher::encryptProductCipherfile');
$routes->post('/ProductCipher/decryptProductCipherfile', 'ProductCipher::decryptProductCipherfile');

$routes->get('download/file/(:any)', 'Download::file/$1');

$routes->get('upload', 'Upload::index');
$routes->post('upload/doUploadPlayfairCipher', 'Upload::doUploadPlayfairCipher');
$routes->post('upload/doUploadProductCipher', 'Upload::doUploadProductCipher');
$routes->post('upload/doUploadVigenereCipher', 'Upload::doUploadVigenereCipher');
$routes->post('upload/doUploadExtendedVigenereCipher', 'Upload::doUploadExtendedVigenereCipher');
