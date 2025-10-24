<?php $__env->startSection('title', 'Donations'); ?>

<?php $__env->startSection('content'); ?>
<!-- Start Hero Section -->
<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="<?php echo e(asset('frontOffice/img/page_heading_bg.jpg')); ?>">
  <div class="container">
    <h1 class="cs_fs_51 cs_white_color cs_mb_11">Gestion des Donations</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
      <li class="breadcrumb-item active">Donations</li>
    </ol>
  </div>
</section>
<!-- End Hero Section -->

<!-- Start Donations Section -->
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
          <h3 class="cs_accent_color cs_fs_21 cs_semibold cs_mb_13">Nos Donations</h3>
          <h2 class="cs_fs_51 cs_mb_29">Gérer vos Contributions</h2>
          <p class="cs_mb_37">Suivez et gérez toutes vos donations pour nos projets environnementaux. Chaque contribution compte pour créer un impact positif sur notre planète.</p>
          
          <!-- Section des filtres -->
          <div class="cs_filters_wrap cs_white_bg cs_shadow_1 cs_padding_medium cs_mb_40">
            <h4 class="cs_fs_21 cs_semibold cs_mb_20 cs_accent_color">Filtrer les Donations</h4>
            <form method="GET" action="<?php echo e(route('donations.index')); ?>" class="cs_filters_form">
              <div class="row cs_gap_y_20">
                <div class="col-md-5">
                  <label for="currency" class="cs_form_label cs_fs_16 cs_semibold cs_mb_8">Devise</label>
                  <select class="cs_form_select" id="currency" name="currency">
                    <option value="">Toutes les devises</option>
                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($currency); ?>" <?php echo e(request('currency') == $currency ? 'selected' : ''); ?>>
                        <?php echo e($currency); ?> - <?php echo e($currency == 'TND' ? 'Dinar Tunisien' : ($currency == 'EUR' ? 'Euro' : ($currency == 'USD' ? 'Dollar US' : ($currency == 'GBP' ? 'Livre Sterling' : ($currency == 'CHF' ? 'Franc Suisse' : $currency))))); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                
                <div class="col-md-4">
                  <label for="payment_method" class="cs_form_label cs_fs_16 cs_semibold cs_mb_8">Méthode de Paiement</label>
                  <select class="cs_form_select" id="payment_method" name="payment_method">
                    <option value="">Toutes les méthodes</option>
                    <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($paymentMethod); ?>" <?php echo e(request('payment_method') == $paymentMethod ? 'selected' : ''); ?>>
                        <?php echo e($paymentMethod == 'Card' ? '💳 Carte Bancaire' : 
                           ($paymentMethod == 'PayPal' ? '🟦 PayPal' : 
                           ($paymentMethod == 'Bank Transfer' ? '🏦 Virement Bancaire' :
                           ($paymentMethod == 'Cash' ? '💵 Espèces' :
                           ($paymentMethod == 'Check' ? '✅ Chèque' :
                           ($paymentMethod == 'Cryptocurrency' ? '₿ Cryptomonnaie' : $paymentMethod)))))); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label for="wallet_id" class="cs_form_label cs_fs_16 cs_semibold cs_mb_8">Wallet</label>
                  <select class="cs_form_select" id="wallet_id" name="wallet_id">
                    <option value="">Tous les wallets</option>
                    <?php $__currentLoopData = $wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($wallet->id); ?>" <?php echo e(request('wallet_id') == $wallet->id ? 'selected' : ''); ?>>
                        <?php echo e($wallet->name); ?> - <?php echo e($wallet->event->name ?? 'N/A'); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
            
                <div class="col-md-2">
                  <button type="submit" class="cs_btn cs_style_1 cs_btn_full cs_btn_sm">
                    <i class="fas fa-filter"></i> Filtrer
                  </button>
                </div>
              </div>
              
              <?php if(request()->has(['currency', 'payment_method', 'wallet_id']) && !empty(array_filter(request()->only(['currency', 'payment_method', 'wallet_id'])))): ?>
                <div class="cs_active_filters cs_mt_20">
                  <span class="cs_filter_label">Filtres actifs :</span>
                  <?php if(request('currency')): ?>
                    <span class="cs_filter_tag cs_currency_tag"><?php echo e(request('currency')); ?></span>
                  <?php endif; ?>
                  <?php if(request('payment_method')): ?>
                    <span class="cs_filter_tag cs_payment_tag"><?php echo e(request('payment_method')); ?></span>
                  <?php endif; ?>
                  <?php if(request('wallet_id')): ?>
                    <?php
                      $selectedWallet = $wallets->firstWhere('id', request('wallet_id'));
                    ?>
                    <span class="cs_filter_tag cs_wallet_tag"><?php echo e($selectedWallet ? $selectedWallet->name : 'Wallet #' . request('wallet_id')); ?></span>
                  <?php endif; ?>
                  <a href="<?php echo e(route('donations.index')); ?>" class="cs_clear_filters">
                    <i class="fas fa-times"></i> Effacer tout
                  </a>
                </div>
              <?php endif; ?>
            </form>
          </div>

          <div class="d-flex justify-content-between mb-4">
            <a href="<?php echo e(route('donations.create')); ?>" class="cs_btn cs_style_1">
              <i class="fas fa-plus"></i> Ajouter une Donation
              <i>
                <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </i>
            </a>
          </div>

          <?php if($donations->count() > 0): ?>
            <div class="cs_table_wrap">
              <div class="cs_table_header">
                <h3 class="cs_table_title">Liste des Donations (<?php echo e($donations->count()); ?> <?php echo e($donations->count() == 1 ? 'donation' : 'donations'); ?>)</h3>
              </div>
              <table class="cs_table cs_style_1">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Montant</th>
                    <th>Wallet</th>
                    <th>Date</th>
                    <th>Méthode</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td>
                        <span class="cs_donation_id">#<?php echo e($donation->id); ?></span>
                      </td>
                      <td>
                        <span class="cs_amount cs_amount_tnd">
                          <?php echo e(App\Helpers\CurrencyHelper::formatTND(App\Helpers\CurrencyHelper::convertToTND($donation->amount, $donation->currency))); ?>

                          <span class="cs_currency_converted_from"><?php echo e($donation->currency); ?></span>
                        </span>
                      </td>
                      <td>
                        <?php if($donation->wallet): ?>
                          <div class="cs_wallet_info">
                            <span class="cs_wallet_name"><?php echo e($donation->wallet->name); ?></span>
                            <span class="cs_wallet_event"><?php echo e($donation->wallet->event->name ?? 'N/A'); ?></span>
                          </div>
                        <?php else: ?>
                          <span class="cs_no_wallet">Aucun wallet</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <span class="cs_date"><?php echo e($donation->date->format('d/m/Y')); ?></span>
                      </td>
                      <td>
                        <span class="cs_payment_badge cs_<?php echo e(strtolower(str_replace(' ', '_', $donation->payment_method))); ?>">
                          <?php if($donation->payment_method == 'Card'): ?> 💳<?php elseif($donation->payment_method == 'PayPal'): ?> 🟦<?php elseif($donation->payment_method == 'Bank Transfer'): ?> 🏦<?php elseif($donation->payment_method == 'Cash'): ?> 💵<?php elseif($donation->payment_method == 'Check'): ?> ✅<?php elseif($donation->payment_method == 'Cryptocurrency'): ?> ₿<?php endif; ?>
                          <?php echo e($donation->payment_method); ?>

                        </span>
                      </td>
                      <td>
                        <div class="cs_action_buttons_group">
                          <a href="<?php echo e(route('donations.show', $donation)); ?>" class="cs_action_btn cs_view_btn" title="Voir les détails">
                            <i class="fas fa-eye"></i>
                          </a>
                          <a href="<?php echo e(route('donations.edit', $donation)); ?>" class="cs_action_btn cs_edit_btn" title="Modifier">
                            <i class="fas fa-edit"></i>
                          </a>
                          <form action="<?php echo e(route('donations.destroy', $donation)); ?>" method="POST" style="display: inline;" 
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette donation?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="cs_action_btn cs_delete_btn" title="Supprimer">
                              <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          <?php else: ?>
            <div class="cs_empty_state text-center">
              <div class="cs_empty_state_icon cs_mb_30">
                <img src="<?php echo e(asset('frontOffice/img/others/feature_icon_1.svg')); ?>" alt="" style="opacity: 0.3;">
              </div>
              <?php if(request()->has(['currency', 'payment_method']) && !empty(array_filter(request()->only(['currency', 'payment_method'])))): ?>
                <h3 class="cs_fs_28 cs_semibold cs_mb_15">Aucun résultat trouvé</h3>
                <p class="cs_mb_30">Aucune donation ne correspond à vos critères de recherche.</p>
                <a href="<?php echo e(route('donations.index')); ?>" class="cs_btn cs_style_2">
                  <i class="fas fa-refresh"></i> Effacer les filtres
                </a>
              <?php else: ?>
                <h3 class="cs_fs_28 cs_semibold cs_mb_15">Aucune donation trouvée</h3>
                <p class="cs_mb_30">Commencez par ajouter votre première donation pour aider nos projets environnementaux.</p>
                <a href="<?php echo e(route('donations.create')); ?>" class="cs_btn cs_style_1">
                  Créer ma première donation
                  <i>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </i>
                </a>
              <?php endif; ?>
            </div>
          <?php endif; ?>

        </div>
      </div>
      <div class="col-lg-4">
        <div class="cs_donation_stats cs_white_bg cs_shadow_1">
          <h3 class="cs_fs_28 cs_semibold cs_mb_30">Statistiques</h3>
          
          <div class="cs_stat_item cs_mb_25">
            <div class="cs_stat_number cs_accent_color cs_fs_38 cs_semibold"><?php echo e($donations->count()); ?></div>
            <div class="cs_stat_label">Total Donations</div>
          </div>
          
          <div class="cs_stat_item cs_mb_25">
            <div class="cs_stat_number cs_accent_color cs_fs_38 cs_semibold"><?php echo e(App\Helpers\CurrencyHelper::formatTND($totalAmountTND)); ?></div>
            <div class="cs_stat_label">Montant Total</div>
          </div>
          
          <div class="cs_stat_item cs_mb_25">
            <div class="cs_stat_number cs_accent_color cs_fs_38 cs_semibold"><?php echo e($donations->where('date', '>=', now()->subMonths(1))->count()); ?></div>
            <div class="cs_stat_label">Ce mois</div>
          </div>
          
          <hr class="cs_mb_30">
          
          <!-- Statistiques par devise -->
          <div class="cs_currency_stats cs_mb_30">
            <h4 class="cs_fs_18 cs_semibold cs_mb_15 cs_accent_color">Par Devise (Montants en TND)</h4>
            <?php $__currentLoopData = $statisticsByCurrency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statistic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="cs_currency_item cs_mb_10">
                <div class="cs_currency_info">
                  <span class="cs_currency_label"><?php echo e($statistic['currency']); ?></span>
                  <span class="cs_currency_conversion"><?php echo e(App\Helpers\CurrencyHelper::formatTND($statistic['amount_tnd'])); ?></span>
                </div>
                <div class="cs_currency_meta">
                  <span class="cs_currency_count"><?php echo e($statistic['count']); ?> donations</span>
                  <span class="cs_currency_original"><?php echo e(number_format($statistic['amount_original'], 2)); ?> <?php echo e($statistic['currency']); ?></span>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          
          <!-- Statistiques par méthode de paiement -->
          <div class="cs_payment_stats cs_mb_30">
            <h4 class="cs_fs_18 cs_semibold cs_mb_15 cs_accent_color">Par Méthode</h4>
            <?php $__currentLoopData = $donations->groupBy('payment_method'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method => $methodDonations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="cs_payment_item cs_mb_10">
                <span class="cs_payment_label"><?php echo e($method); ?></span>
                <span class="cs_payment_count"><?php echo e(count($methodDonations)); ?></span>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          
          <div class="text-center">
            <a href="<?php echo e(route('donations.create')); ?>" class="cs_btn cs_style_1 w-100">
              <i class="fas fa-heart"></i> Nouvelle Donation
            </a>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
</section>
<!-- End Donations Section -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontOffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/donations/index.blade.php ENDPATH**/ ?>