
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
   <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
      <div class="sidebar-brand-icon rotate-n-15">
		    <i class="fas fa-paste"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Reimbur App</div>
   </a>
   <hr class="sidebar-divider my-0">
   <li class="nav-item">
		<a class="nav-link" href="/dashboard">
		  <i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</a>
   </li>

   <li class="nav-item">
      <a class="nav-link" href="/reimbursement">
        <i class="fas fa-fw fa-clipboard"></i>
         <span>Reimbursement</span>
      </a>
   </li>

   @can('isDirektur')
   <li class="nav-item">
      <a class="nav-link" href="/daftar/reimbursement">
        <i class="fas fa-fw fa-gavel"></i>
         <span>Validasi Reimbursement</span>
      </a>
   </li>
   @endcan

   <li class="nav-item">
      <a class="nav-link" href="/list/reimbursement">
        <i class="fas fa-fw fa-wallet"></i>
         <span>Pembayaran</span>
      </a>
   </li>
	
   @can('isDirektur')
   <hr class="sidebar-divider">
   <div class="sidebar-heading">
      Direktur
   </div>
   <li class="nav-item">
      <a class="nav-link" href="/karyawan">
         <i class="fas fa-fw fa-users"></i>
         <span>Karyawan</span>
      </a>
   </li>
   @endcan

   <hr class="sidebar-divider d-none d-md-block">
   <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
   </div>
</ul>