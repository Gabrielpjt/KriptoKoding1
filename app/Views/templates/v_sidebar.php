 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Kriptografi dan Koding</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">


     <!-- Nav Item - Dashboard -->
     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('VigenereCipher'); ?>">
             <i class="fas fa-fw fa-table"></i>
             <span>Vigenere Cipher standard</span></a>
     </li>

     <!-- Nav Item - Dashboard -->
     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('ExtendedVigenereCipher'); ?>">
             <i class="fas fa-fw fa-table"></i>
             <span>Extended Viginere Cipher </span></a>
     </li>

     <!-- Nav Item - Dashboard -->
     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('PlayfairCipher'); ?>">
             <i class="fas fa-fw fa-table"></i>
             <span>Playfair Cipher</span></a>
     </li>

     <!-- Nav Item - Dashboard -->
     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('ProductCipher'); ?>">
             <i class="fas fa-fw fa-table"></i>
             <span>Product Cipher</span></a>
     </li>

     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('AffineCipher'); ?>">
             <i class="fas fa-fw fa-table"></i>
             <span>Affine Cipher</span></a>
     </li>

     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('AutokeyVigenereCipher'); ?>">
             <i class="fas fa-fw fa-table"></i>
             <span>Autokey Vigenere Cipher</span></a>
     </li>

 </ul>
 <!-- End of Sidebar -->