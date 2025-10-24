<?php $__env->startSection('title', 'Taux de Change en Temps Réel'); ?>

<?php $__env->startSection('content'); ?>
<!-- Start Hero Section -->
<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="<?php echo e(asset('frontOffice/img/page_heading_bg.jpg')); ?>">
  <div class="container">
    <h1 class="cs_fs_51 cs_white_color cs_mb_11">Taux de Change en Temps Réel</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
      <li class="breadcrumb-item active">Taux de Change</li>
    </ol>
  </div>
</section>
<!-- End Hero Section -->

<!-- Start Currency Section -->
<section class="cs_shape_wrap">
  <div class="cs_height_140 cs_height_lg_70"></div>
  <div class="cs_shape cs_shape_position_1"><img src="<?php echo e(asset('frontOffice/img/nature/about_shape_1.svg')); ?>" alt=""></div>
  <div class="container">
    
    <?php if(session('success')): ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 15px;">
            <i class="fa fa-check-circle"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <div class="row">
      <div class="col-lg-8">
        <div class="cs_pl_75">
          <h3 class="cs_accent_color cs_fs_21 cs_semibold cs_mb_13">Convertisseur de Devises</h3>
          <h2 class="cs_fs_51 cs_mb_29">Taux de Change en Temps Réel</h2>
          <p class="cs_mb_37">Convertissez vos montants de donation en temps réel avec les taux de change les plus récents. Nos taux sont mis à jour toutes les 5 minutes pour vous offrir la précision maximale.</p>
          
          <!-- Convertisseur de devises -->
          <div class="cs_white_bg cs_shadow_1 cs_padding_large cs_mb_40">
            <h4 class="cs_fs_21 cs_semibold cs_mb_20 cs_accent_color">Convertisseur Instantané</h4>
            <div class="row cs_gap_y_20">
              <div class="col-md-4">
                <label for="convertAmount" class="cs_form_label cs_fs_16 cs_semibold cs_mb_8">Montant</label>
                <input type="number" id="convertAmount" class="cs_form_input" placeholder="0.00" step="0.01" min="0">
              </div>
              <div class="col-md-3">
                <label for="convertFrom" class="cs_form_label cs_fs_16 cs_semibold cs_mb_8">De</label>
                <select id="convertFrom" class="cs_form_select">
                  <?php $__currentLoopData = $supportedCurrencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($code); ?>" <?php echo e($code == 'EUR' ? 'selected' : ''); ?>>
                      <?php echo e($code); ?> - <?php echo e($name); ?>

                    </option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="col-md-1 text-center d-flex align-items-end">
                <button type="button" class="cs_btn cs_style_1 cs_btn_sm" onclick="swapCurrencies()">
                  <i class="fas fa-exchange-alt"></i>
                </button>
              </div>
              <div class="col-md-3">
                <label for="convertTo" class="cs_form_label cs_fs_16 cs_semibold cs_mb_8">Vers</label>
                <select id="convertTo" class="cs_form_select">
                  <?php $__currentLoopData = $supportedCurrencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($code); ?>" <?php echo e($code == 'TND' ? 'selected' : ''); ?>>
                      <?php echo e($code); ?> - <?php echo e($name); ?>

                    </option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="cs_btn cs_style_1 cs_btn_sm" onclick="convertCurrency()">
                  <i class="fas fa-calculator"></i>
                </button>
              </div>
            </div>
            <div id="convertResult" class="cs_mt_20"></div>
            <div id="rateInfo" class="cs_mt_15"></div>
          </div>

          <?php if($liveRates && $liveRates['success']): ?>
            <div class="cs_white_bg cs_shadow_1 cs_padding_large">
              <h4 class="cs_fs_21 cs_semibold cs_mb_20 cs_accent_color">Taux de Change Actuels</h4>
              <div class="row cs_mb_20">
                <div class="col-md-6">
                  <p class="cs_mb_0"><strong>Devise de base:</strong> <?php echo e($liveRates['base']); ?></p>
                </div>
                <div class="col-md-6">
                  <p class="cs_mb_0"><strong>Dernière mise à jour:</strong> <?php echo e($liveRates['date']); ?></p>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="cs_table cs_style_1">
                  <thead>
                    <tr>
                      <th>Devise</th>
                      <th>Nom</th>
                      <th>Taux</th>
                      <th>Symbole</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $supportedCurrencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if(isset($liveRates['rates'][$code]) || $code == $liveRates['base']): ?>
                        <tr>
                          <td><strong><?php echo e($code); ?></strong></td>
                          <td><?php echo e($name); ?></td>
                          <td>
                            <?php if($code == $liveRates['base']): ?>
                              <span class="badge bg-primary">Devise de base</span>
                            <?php else: ?>
                              <?php echo e(number_format($liveRates['rates'][$code], 4)); ?>

                            <?php endif; ?>
                          </td>
                          <td>
                            <?php
                              $symbols = [
                                'TND' => 'د.ت',
                                'USD' => '$',
                                'EUR' => '€',
                                'GBP' => '£',
                                'CHF' => 'CHF',
                                'CAD' => 'C$',
                                'AUD' => 'A$',
                                'JPY' => '¥',
                                'CNY' => '¥',
                                'AED' => 'د.إ',
                                'SAR' => 'ر.س',
                                'EGP' => '£',
                                'MAD' => 'د.م.',
                                'DZD' => 'د.ج',
                              ];
                            ?>
                            <?php echo e($symbols[$code] ?? $code); ?>

                          </td>
                        </tr>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
            </div>
          <?php else: ?>
            <div class="cs_white_bg cs_shadow_1 cs_padding_large">
              <div class="alert alert-warning">
                <h4>Service temporairement indisponible</h4>
                <p>Les taux de change en temps réel ne sont pas disponibles pour le moment. Veuillez réessayer plus tard.</p>
                <p>Le système utilise actuellement les taux de change de secours.</p>
              </div>
            </div>
          <?php endif; ?>

        </div>
      </div>
      
      <div class="col-lg-4">
        <div class="cs_currency_info cs_white_bg cs_shadow_1">
          <h3 class="cs_fs_28 cs_semibold cs_mb_30">Informations</h3>
          
          <div class="cs_info_item cs_mb_25">
            <div class="cs_info_icon cs_accent_color cs_fs_38 cs_semibold">
              <i class="fas fa-clock"></i>
            </div>
            <div class="cs_info_content">
              <h4 class="cs_fs_18 cs_semibold">Temps Réel</h4>
              <p class="cs_mb_0">Taux mis à jour toutes les 5 minutes</p>
            </div>
          </div>
          
          <div class="cs_info_item cs_mb_25">
            <div class="cs_info_icon cs_accent_color cs_fs_38 cs_semibold">
              <i class="fas fa-globe"></i>
            </div>
            <div class="cs_info_content">
              <h4 class="cs_fs_18 cs_semibold">14 Devises</h4>
              <p class="cs_mb_0">Support des principales devises mondiales</p>
            </div>
          </div>
          
          <div class="cs_info_item cs_mb_25">
            <div class="cs_info_icon cs_accent_color cs_fs_38 cs_semibold">
              <i class="fas fa-shield-alt"></i>
            </div>
            <div class="cs_info_content">
              <h4 class="cs_fs_18 cs_semibold">Sécurisé</h4>
              <p class="cs_mb_0">Sources officielles et vérifiées</p>
            </div>
          </div>
          
          <div class="cs_info_item cs_mb_25">
            <div class="cs_info_icon cs_accent_color cs_fs_38 cs_semibold">
              <i class="fas fa-gift"></i>
            </div>
            <div class="cs_info_content">
              <h4 class="cs_fs_18 cs_semibold">Gratuit</h4>
              <p class="cs_mb_0">Service entièrement gratuit</p>
            </div>
          </div>
          
          <div class="text-center cs_mt_30">
            <a href="<?php echo e(route('donations.create')); ?>" class="cs_btn cs_style_1 w-100">
              <i class="fas fa-heart"></i> Faire une Donation
            </a>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
</section>
<!-- End Currency Section -->

<script>
function convertCurrency() {
    const amount = document.getElementById('convertAmount').value;
    const from = document.getElementById('convertFrom').value;
    const to = document.getElementById('convertTo').value;
    const resultDiv = document.getElementById('convertResult');
    const rateDiv = document.getElementById('rateInfo');
    
    if (!amount || amount <= 0) {
        resultDiv.innerHTML = '<div class="alert alert-warning">Veuillez entrer un montant valide</div>';
        return;
    }
    
    if (from === to) {
        resultDiv.innerHTML = '<div class="alert alert-info">Les devises sont identiques</div>';
        return;
    }
    
    resultDiv.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"></div> Conversion...';
    rateDiv.innerHTML = '';
    
    fetch('<?php echo e(route("currency.convert")); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        },
        body: JSON.stringify({
            amount: parseFloat(amount),
            from: from,
            to: to
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            resultDiv.innerHTML = `
                <div class="alert alert-success">
                    <h5><strong>${amount} ${from}</strong> = <strong>${data.formatted}</strong></h5>
                </div>
            `;
            if (data.rate) {
                rateDiv.innerHTML = `
                    <div class="alert alert-info">
                        <small>Taux de change: 1 ${from} = ${data.rate.toFixed(4)} ${to}</small>
                    </div>
                `;
            }
        } else {
            resultDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(error => {
        resultDiv.innerHTML = '<div class="alert alert-danger">Erreur lors de la conversion</div>';
    });
}

function swapCurrencies() {
    const fromSelect = document.getElementById('convertFrom');
    const toSelect = document.getElementById('convertTo');
    const fromValue = fromSelect.value;
    const toValue = toSelect.value;
    
    fromSelect.value = toValue;
    toSelect.value = fromValue;
    
    // Déclencher la conversion automatiquement
    convertCurrency();
}

// Conversion automatique lors du changement des valeurs
document.getElementById('convertAmount').addEventListener('input', convertCurrency);
document.getElementById('convertFrom').addEventListener('change', convertCurrency);
document.getElementById('convertTo').addEventListener('change', convertCurrency);

// Conversion automatique au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('convertAmount').value = '100';
    convertCurrency();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontOffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/currency/index.blade.php ENDPATH**/ ?>