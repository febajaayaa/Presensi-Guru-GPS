

<?php $__env->startSection('title', 'Approval Cuti & Izin'); ?>

<?php $__env->startPush('styles'); ?>
<style>
  body { background: #F0F4F8; }

  .approval-wrap {
    padding: 32px 36px;
    min-height: 100vh;
    font-family: 'Figtree', sans-serif;
    background: #F0F4F8;
  }

  /* ── Page Header ── */
  .page-header { margin-bottom: 28px; }
  .page-label  { font-size: 12px; font-weight: 600; color: #64748B; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 4px; }
  .page-title  { font-size: 24px; font-weight: 700; color: #0F172A; display: flex; align-items: center; gap: 10px; }
  .page-subtitle { font-size: 13px; color: #64748B; margin-top: 4px; }

  /* ── Section ── */
  .section-block { margin-bottom: 36px; }
  .section-title {
    font-size: 16px; font-weight: 700; color: #0F172A;
    display: flex; align-items: center; gap: 8px;
    margin-bottom: 14px;
  }

  /* ── Filter Tabs ── */
  .filter-tabs { display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap; }
  .tab-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 16px; border-radius: 999px; font-size: 13px; font-weight: 600;
    cursor: pointer; border: 1.5px solid #E2E8F0;
    background: #fff; color: #475569;
    transition: all 0.15s;
  }
  .tab-btn.active { background: #3B82F6; color: #fff; border-color: #3B82F6; }
  .tab-count {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 20px; height: 20px; border-radius: 999px;
    padding: 0 5px; font-size: 11px; font-weight: 700;
  }
  .tab-btn.active .tab-count          { background: rgba(255,255,255,0.25); color: #fff; }
  .tab-btn.tab-menunggu .tab-count    { background: #FEF3C7; color: #B45309; }
  .tab-btn.tab-disetujui .tab-count   { background: #DCFCE7; color: #15803D; }
  .tab-btn.tab-ditolak .tab-count     { background: #FEE2E2; color: #B91C1C; }

  /* ── Table Card ── */
  .table-card {
    background: #fff;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(15,23,42,0.06);
  }
  table { width: 100%; border-collapse: collapse; }
  thead th {
    padding: 13px 18px; text-align: left;
    font-size: 11px; font-weight: 700; letter-spacing: 0.07em;
    text-transform: uppercase; color: #fff;
    background: #3B82F6;
  }
  tbody td {
    padding: 14px 18px; font-size: 14px; color: #1E293B;
    border-bottom: 1px solid #F1F5F9; vertical-align: middle;
  }
  tbody tr:last-child td { border-bottom: none; }
  tbody tr:hover { background: #F8FAFF; }

  /* ── Avatar ── */
  .avatar {
    width: 38px; height: 38px; border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 15px; flex-shrink: 0;
  }
  .av-blue   { background: #DBEAFE; color: #1D4ED8; }
  .av-green  { background: #DCFCE7; color: #15803D; }
  .av-amber  { background: #FEF3C7; color: #B45309; }
  .av-rose   { background: #FFE4E6; color: #BE123C; }
  .av-purple { background: #EDE9FE; color: #7C3AED; }
  .av-teal   { background: #CCFBF1; color: #0F766E; }

  .guru-cell { display: flex; align-items: center; gap: 12px; }
  .guru-name { font-weight: 600; color: #0F172A; font-size: 14px; }
  .guru-role { font-size: 12px; color: #94A3B8; margin-top: 1px; }

  /* ── Status Badge ── */
  .status-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 12px; border-radius: 999px;
    font-size: 12px; font-weight: 600;
  }
  .status-badge .dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
  .s-menunggu       { background: #FEF3C7; color: #92400E; }
  .s-menunggu .dot  { background: #F59E0B; }
  .s-disetujui      { background: #DCFCE7; color: #15803D; }
  .s-disetujui .dot { background: #22C55E; }
  .s-ditolak        { background: #FEE2E2; color: #B91C1C; }
  .s-ditolak .dot   { background: #EF4444; }

  /* ── Jenis Badge ── */
  .jenis-badge {
    display: inline-block; padding: 4px 12px; border-radius: 8px;
    font-size: 12px; font-weight: 600;
  }
  .jenis-pribadi  { background: #DBEAFE; color: #1D4ED8; }
  .jenis-keluarga { background: #EDE9FE; color: #6D28D9; }
  .jenis-dinas    { background: #CCFBF1; color: #0F766E; }
  .jenis-sakit    { background: #FEF3C7; color: #92400E; }
  .jenis-lainnya  { background: #F1F5F9; color: #475569; }
  .jenis-ujian    { background: #FFE4E6; color: #BE123C; }

  /* ── Action Buttons ── */
  .btn-setujui {
    padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 600;
    border: 1.5px solid #86EFAC; color: #15803D; background: #F0FDF4;
    cursor: pointer; transition: all 0.15s; display: inline-flex; align-items: center; gap: 4px;
  }
  .btn-setujui:hover { background: #DCFCE7; border-color: #4ADE80; }
  .btn-tolak {
    padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 600;
    border: 1.5px solid #FCA5A5; color: #B91C1C; background: #FFF1F2;
    cursor: pointer; transition: all 0.15s; display: inline-flex; align-items: center; gap: 4px;
  }
  .btn-tolak:hover { background: #FEE2E2; border-color: #F87171; }
  .action-group { display: flex; gap: 8px; }

  /* ── Table Footer ── */
  .table-footer {
    padding: 12px 18px; font-size: 13px; color: #94A3B8;
    border-top: 1px solid #F1F5F9; background: #FAFBFF;
  }

  /* ── Empty State ── */
  .empty-state { text-align: center; padding: 48px 20px; color: #94A3B8; }
  .empty-state-icon { font-size: 36px; margin-bottom: 10px; }

  /* ── Alert ── */
  .alert {
    padding: 13px 18px; border-radius: 10px; margin-bottom: 20px;
    font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 8px;
  }
  .alert-success { background: #F0FDF4; color: #15803D; border: 1px solid #86EFAC; }
  .alert-error   { background: #FFF1F2; color: #B91C1C; border: 1px solid #FCA5A5; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="approval-wrap">

  
  <?php if(session('success')): ?>
    <div class="alert alert-success">
      <i class="ti ti-circle-check" style="font-size:18px;"></i> <?php echo e(session('success')); ?>

    </div>
  <?php endif; ?>
  <?php if(session('error')): ?>
    <div class="alert alert-error">
      <i class="ti ti-circle-x" style="font-size:18px;"></i> <?php echo e(session('error')); ?>

    </div>
  <?php endif; ?>

  
  <div class="page-header">   
    <div class="page-title">
      <i class="ti ti-checkbox" style="font-size:26px; color:#3B82F6;"></i>
      Approval Cuti & Izin
    </div>
    <p class="page-subtitle">Kelola permohonan cuti dan izin dari guru.</p>
  </div>

  
  <div class="section-block">
    <div class="section-title">
      
      Approval Cuti
    </div>

    <?php
      $cutiSemua     = $cutis->count();
      $cutiMenunggu  = $cutis->where('status', 'pending')->count();
      $cutiDisetujui = $cutis->where('status', 'disetujui')->count();
      $cutiDitolak   = $cutis->where('status', 'ditolak')->count();
    ?>

    <div class="filter-tabs" id="tabs-cuti">
      <button class="tab-btn active" onclick="filterTable('cuti','semua',this)">
        <span class="tab-count" style="background:rgba(255,255,255,0.25); color:#fff;"><?php echo e($cutiSemua); ?></span> Semua
      </button>
      <button class="tab-btn tab-menunggu" onclick="filterTable('cuti','pending',this)">
        Menunggu <span class="tab-count"><?php echo e($cutiMenunggu); ?></span>
      </button>
      <button class="tab-btn tab-disetujui" onclick="filterTable('cuti','disetujui',this)">
        <span style="color:#22C55E; font-size:10px;">●</span> Disetujui <span class="tab-count"><?php echo e($cutiDisetujui); ?></span>
      </button>
      <button class="tab-btn tab-ditolak" onclick="filterTable('cuti','ditolak',this)">
        <span style="color:#EF4444; font-size:10px;">●</span> Ditolak <span class="tab-count"><?php echo e($cutiDitolak); ?></span>
      </button>
    </div>

    <div class="table-card">
      <table id="table-cuti">
        <thead>
          <tr>
            <th>Guru</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Jenis Cuti</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $cutis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr data-status="<?php echo e($cuti->status); ?>">

            <td>
              <div class="guru-cell">
                <?php
                  $colors = ['av-blue','av-green','av-amber','av-rose','av-purple','av-teal'];
                  $avatarClass = $colors[$cuti->user->id % count($colors)];
                ?>
                <div class="avatar <?php echo e($avatarClass); ?>">
                  <?php echo e(strtoupper(substr($cuti->user->name, 0, 1))); ?>

                </div>
                <div>
                  <div class="guru-name"><?php echo e($cuti->user->name); ?></div>
                  <div class="guru-role"><?php echo e($cuti->user->jabatan ?? 'Guru'); ?></div>
                </div>
              </div>
            </td>
           
            <td style="color:#64748B;"><?php echo e(\Carbon\Carbon::parse($cuti->tanggal_mulai)->format('Y-m-d')); ?></td>
            <td style="color:#64748B;"><?php echo e(\Carbon\Carbon::parse($cuti->tanggal_selesai)->format('Y-m-d')); ?></td>

            <td>
              <?php
                $jenisCuti = strtolower($cuti->jenis_cuti ?? '');
                $cutiClass = str_contains($jenisCuti, 'sakit')    ? 'jenis-sakit'
                           : (str_contains($jenisCuti, 'keluarga') ? 'jenis-keluarga'
                           : (str_contains($jenisCuti, 'dinas')    ? 'jenis-dinas'
                           : (str_contains($jenisCuti, 'ujian')    ? 'jenis-ujian'
                           : 'jenis-lainnya')));
              ?>
              <span class="jenis-badge <?php echo e($cutiClass); ?>">
                <?php echo e(ucwords($cuti->jenis_cuti ?? 'Cuti')); ?>

              </span>
              <td style="max-width:200px; color:#94A3B8; font-size:13px;">
  <?php echo e(Str::limit($cuti->keterangan ?? '—', 55)); ?>

</td>
            </td>

            <td>
              <?php if($cuti->status == 'disetujui'): ?>
                <span class="status-badge s-disetujui"><span class="dot"></span>Disetujui</span>
              <?php elseif($cuti->status == 'ditolak'): ?>
                <span class="status-badge s-ditolak"><span class="dot"></span>Ditolak</span>
              <?php else: ?>
                <span class="status-badge s-menunggu"><span class="dot"></span>Menunggu</span>
              <?php endif; ?>
            </td>

            <td>
              <?php if($cuti->status == 'pending'): ?>
                <div class="action-group">
                  <form action="<?php echo e(route('cuti.setujui', $cuti->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="btn-setujui">
                      <i class="ti ti-check" style="font-size:13px;"></i> Setujui
                    </button>
                  </form>
                  <form action="<?php echo e(route('cuti.tolak', $cuti->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="btn-tolak">
                      <i class="ti ti-x" style="font-size:13px;"></i> Tolak
                    </button>
                  </form>
                </div>
              <?php else: ?>
                <span style="color:#CBD5E1; font-size:16px;">—</span>
              <?php endif; ?>
            </td>

          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="7">
              <div class="empty-state">
                <div class="empty-state-icon">📋</div>
                Belum ada pengajuan cuti.
              </div>
            </td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
      <div class="table-footer">
        Menampilkan 1–<?php echo e($cutis->count()); ?> dari <?php echo e($cutis->count()); ?> data
      </div>
    </div>
  </div>

  
  <div class="section-block">
    <div class="section-title">
     Approval Izin
    </div>

    <?php
      $izinSemua     = $izins->count();
      $izinMenunggu  = $izins->where('status', 'pending')->count();
      $izinDisetujui = $izins->where('status', 'disetujui')->count();
      $izinDitolak   = $izins->where('status', 'ditolak')->count();
    ?>

    <div class="filter-tabs" id="tabs-izin">
      <button class="tab-btn active" onclick="filterTable('izin','semua',this)">
        <span class="tab-count" style="background:rgba(255,255,255,0.25); color:#fff;"><?php echo e($izinSemua); ?></span> Semua
      </button>
      <button class="tab-btn tab-menunggu" onclick="filterTable('izin','pending',this)">
        Menunggu <span class="tab-count"><?php echo e($izinMenunggu); ?></span>
      </button>
      <button class="tab-btn tab-disetujui" onclick="filterTable('izin','disetujui',this)">
        <span style="color:#22C55E; font-size:10px;">●</span> Disetujui <span class="tab-count"><?php echo e($izinDisetujui); ?></span>
      </button>
      <button class="tab-btn tab-ditolak" onclick="filterTable('izin','ditolak',this)">
        <span style="color:#EF4444; font-size:10px;">●</span> Ditolak <span class="tab-count"><?php echo e($izinDitolak); ?></span>
      </button>
    </div>

    <div class="table-card">
      <table id="table-izin">
        <thead>
          <tr>
            <th>Guru</th>
            <th>Tanggal</th>
            <th>Jenis Izin</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $izins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $izin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr data-status="<?php echo e($izin->status); ?>">

            <td>
              <div class="guru-cell">
                <?php
                  $colors = ['av-blue','av-green','av-amber','av-rose','av-purple','av-teal'];
                  $avatarClass = $colors[$izin->user->id % count($colors)];
                ?>
                <div class="avatar <?php echo e($avatarClass); ?>">
                  <?php echo e(strtoupper(substr($izin->user->name, 0, 1))); ?>

                </div>
                <div>
                  <div class="guru-name"><?php echo e($izin->user->name); ?></div>
                  <div class="guru-role"><?php echo e($izin->user->jabatan ?? 'Guru'); ?></div>
                </div>
              </div>
            </td>

            <td style="color:#64748B;"><?php echo e(\Carbon\Carbon::parse($izin->tanggal_mulai)->format('Y-m-d')); ?></td>

            <td>
              <?php
                $jenis = strtolower($izin->jenis ?? '');
                $izinClass = str_contains($jenis, 'sakit')    ? 'jenis-sakit'
                           : (str_contains($jenis, 'keluarga') ? 'jenis-keluarga'
                           : (str_contains($jenis, 'dinas')    ? 'jenis-dinas'
                           : 'jenis-pribadi'));
                $izinLabel = str_contains($jenis, 'sakit') ? 'Izin Sakit'
                           : (str_contains($jenis, 'keluarga') ? 'Izin Keluarga'
                           : (str_contains($jenis, 'dinas')    ? 'Izin Dinas'
                           : ucwords($jenis ?: 'Izin Pribadi')));
              ?>
              <span class="jenis-badge <?php echo e($izinClass); ?>"><?php echo e($izinLabel); ?></span>
            </td>

            <td style="max-width:200px; color:#94A3B8; font-size:13px;">
              <?php echo e(Str::limit($izin->keterangan ?? '—', 55)); ?>

            </td>

            <td>
              <?php if($izin->status == 'disetujui'): ?>
                <span class="status-badge s-disetujui"><span class="dot"></span>Disetujui</span>
              <?php elseif($izin->status == 'ditolak'): ?>
                <span class="status-badge s-ditolak"><span class="dot"></span>Ditolak</span>
              <?php else: ?>
                <span class="status-badge s-menunggu"><span class="dot"></span>Menunggu</span>
              <?php endif; ?>
            </td>

            <td>
              <?php if($izin->status == 'pending'): ?>
                <div class="action-group">
                  <form action="<?php echo e(route('izin.setujui', $izin->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="btn-setujui">
                      <i class="ti ti-check" style="font-size:13px;"></i> Setujui
                    </button>
                  </form>
                  <form action="<?php echo e(route('izin.tolak', $izin->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="btn-tolak">
                      <i class="ti ti-x" style="font-size:13px;"></i> Tolak
                    </button>
                  </form>
                </div>
              <?php else: ?>
                <span style="color:#CBD5E1; font-size:16px;">—</span>
              <?php endif; ?>
            </td>

          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="6">
              <div class="empty-state">
                <div class="empty-state-icon">📋</div>
                Belum ada pengajuan izin.
              </div>
            </td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
      <div class="table-footer">
        Menampilkan 1–<?php echo e($izins->count()); ?> dari <?php echo e($izins->count()); ?> data
      </div>
    </div>
  </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  function filterTable(tableId, status, btn) {
    const tabsContainer = document.getElementById('tabs-' + tableId);
    tabsContainer.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const table = document.getElementById('table-' + tableId);
    const rows  = table.querySelectorAll('tbody tr[data-status]');
    rows.forEach(row => {
      row.style.display = (status === 'semua' || row.dataset.status === status) ? '' : 'none';
    });
  }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\presensi-app\resources\views/admin/izin/index.blade.php ENDPATH**/ ?>