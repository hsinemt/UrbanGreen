<?php $__env->startSection('title', 'Add Resource to Event'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Start Hero Section -->
    <section class="cs_page_heading cs_bg_filed cs_center text_center cs_heading_bg" data-src="<?php echo e(asset('frontOffice/img/page_heading_bg.jpg')); ?>">
        <div class="container">
            <h1 class="cs_fs_51 cs_white_color cs_mb_11">Add Resources to Event</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('events.index')); ?>">Events</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('events.show', $event->id)); ?>"><?php echo e(Str::limit($event->name, 30)); ?></a></li>
                <li class="breadcrumb-item active">Add Resource</li>
            </ol>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start Add Resource Section -->
    <section class="cs_shape_wrap">
        <div class="cs_height_140 cs_height_lg_70"></div>
        <div class="cs_shape cs_shape_position_1"><img src="<?php echo e(asset('frontOffice/img/nature/about_shape_1.svg')); ?>" alt=""></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="cs_section_heading cs_style_1 text_center cs_mb_60">
                        <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13">Supplier Contribution</h3>
                        <h2 class="cs_fs_51 cs_mb_15">Add Your Resources</h2>
                        <p class="cs_mb_0">As a supplier, contribute resources to support this event. Fill in the details below to add your contribution.</p>
                    </div>

                    <!-- Event Information Card - IMPROVED VERSION -->
                    <div class="event-info-card cs_mb_40">
                        <div class="card-header-improved">
                            <div class="header-icon-improved">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <h3 class="header-title-improved">Event Information</h3>
                        </div>

                        <div class="card-content-improved">
                            <div class="info-grid-improved">
                                <!-- Event Name -->
                                <div class="info-item-improved">
                                    <span class="info-label-improved">
                                        <i class="fas fa-tag"></i> Event Name
                                    </span>
                                    <p class="info-value-improved"><?php echo e($event->name); ?></p>
                                </div>

                                <!-- Date -->
                                <div class="info-item-improved">
                                    <span class="info-label-improved">
                                        <i class="fas fa-clock"></i> Date
                                    </span>
                                    <p class="info-value-improved"><?php echo e($event->date ? ($event->date instanceof \Illuminate\Support\Carbon ? $event->date->format('F d, Y') : $event->date) : 'N/A'); ?></p>
                                </div>

                                <!-- Location -->
                                <div class="info-item-improved">
                                    <span class="info-label-improved">
                                        <i class="fas fa-map-marker-alt"></i> Location
                                    </span>
                                    <p class="info-value-improved"><?php echo e($event->location ?? 'N/A'); ?></p>
                                </div>

                                <!-- Supplier -->
                                <div class="info-item-improved">
                                    <span class="info-label-improved">
                                        <i class="fas fa-user-tie"></i> Supplier
                                    </span>
                                    <p class="info-value-improved supplier-link-improved"><?php echo e(Auth::user()->display_name ?? Auth::user()->name); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Improved Card Styles -->
                    <style>
                        .event-info-card {
                            background: white;
                            border-radius: 12px;
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08), 0 4px 16px rgba(0, 0, 0, 0.06);
                            overflow: hidden;
                            transition: all 0.3s ease;
                            border-left: 5px solid #4CAF50;
                        }

                        .event-info-card:hover {
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12), 0 8px 24px rgba(0, 0, 0, 0.08);
                            transform: translateY(-2px);
                        }

                        .card-header-improved {
                            display: flex;
                            align-items: center;
                            gap: 12px;
                            padding: 18px 24px;
                            background: linear-gradient(135deg, #f1f8f4 0%, #e8f5e9 100%);
                            border-bottom: 1px solid #c8e6c9;
                        }

                        .header-icon-improved {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            width: 36px;
                            height: 36px;
                            background: #4CAF50;
                            color: white;
                            border-radius: 8px;
                            font-size: 16px;
                        }

                        .header-title-improved {
                            margin: 0;
                            font-size: 16px;
                            font-weight: 600;
                            color: #1a3a1a;
                            letter-spacing: 0.3px;
                        }

                        .card-content-improved {
                            padding: 24px;
                        }

                        .info-grid-improved {
                            display: grid;
                            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                            gap: 20px;
                        }

                        .info-item-improved {
                            display: flex;
                            flex-direction: column;
                            gap: 6px;
                        }

                        .info-label-improved {
                            display: flex;
                            align-items: center;
                            gap: 8px;
                            font-size: 12px;
                            font-weight: 700;
                            text-transform: uppercase;
                            color: #64748b;
                            letter-spacing: 0.5px;
                        }

                        .info-label-improved i {
                            color: #4CAF50;
                            font-size: 14px;
                        }

                        .info-value-improved {
                            margin: 0;
                            font-size: 15px;
                            font-weight: 500;
                            color: #1e293b;
                            word-break: break-word;
                        }

                        .supplier-link-improved {
                            color: #4CAF50;
                            font-weight: 600;
                        }

                        @media (max-width: 768px) {
                            .info-grid-improved {
                                grid-template-columns: 1fr;
                                gap: 16px;
                            }

                            .card-header-improved {
                                padding: 16px 18px;
                            }

                            .card-content-improved {
                                padding: 18px;
                            }

                            .header-title-improved {
                                font-size: 15px;
                            }
                        }

                        @media (max-width: 480px) {
                            .event-info-card {
                                border-left-width: 4px;
                                border-radius: 8px;
                            }

                            .header-icon-improved {
                                width: 32px;
                                height: 32px;
                                font-size: 14px;
                            }
                        }
                    </style>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show cs_mb_30" role="alert">
                            <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show cs_mb_30" role="alert">
                            <i class="fas fa-exclamation-circle"></i> <?php echo e(session('error')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Resource Form - IMPROVED VERSION -->
                    <div class="resource-form-card">
                        <div class="form-header-section">
                            <div class="form-header-icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <h5 class="form-header-title">Resource Details</h5>
                        </div>

                        <form action="<?php echo e(route('resources.store-to-event', $event->id)); ?>" method="POST" id="resourceForm" class="form-content">
                            <?php echo csrf_field(); ?>

                            <div class="row cs_gap_y_30">
                                <!-- Resource Name -->
                                <div class="col-md-12">
                                    <div class="form-field-wrapper">
                                        <label for="name" class="form-label-improved">
                                            <i class="fas fa-tag"></i> Resource Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               class="form-input-improved <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               id="name"
                                               name="name"
                                               value="<?php echo e(old('name', request('suggested_name'))); ?>"
                                               placeholder="e.g., Folding Chairs, Sound System, Catering Supplies"
                                               required>
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="cs_invalid_feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <small class="form-hint">
                                            <i class="fas fa-info-circle"></i> Enter a descriptive name for the resource
                                        </small>
                                    </div>
                                </div>

                                <!-- Resource Type and Quantity -->
                                <div class="col-md-6">
                                    <div class="form-field-wrapper">
                                        <label for="type" class="form-label-improved">
                                            <i class="fas fa-layer-group"></i> Resource Type <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select-improved <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                id="type"
                                                name="type"
                                                required>
                                            <option value="" disabled <?php echo e(old('type') ? '' : 'selected'); ?>>Choose resource type...</option>
                                            <option value="Equipment" <?php echo e(old('type') == 'Equipment' ? 'selected' : ''); ?>>🔧 Equipment</option>
                                            <option value="Furniture" <?php echo e(old('type') == 'Furniture' ? 'selected' : ''); ?>>🪑 Furniture</option>
                                            <option value="Food & Beverage" <?php echo e(old('type') == 'Food & Beverage' ? 'selected' : ''); ?>>🍽️ Food & Beverage</option>
                                            <option value="Decoration" <?php echo e(old('type') == 'Decoration' ? 'selected' : ''); ?>>🎨 Decoration</option>
                                            <option value="Technology" <?php echo e(old('type') == 'Technology' ? 'selected' : ''); ?>>💻 Technology</option>
                                            <option value="Materials" <?php echo e(old('type') == 'Materials' ? 'selected' : ''); ?>>📦 Materials</option>
                                            <option value="Transportation" <?php echo e(old('type') == 'Transportation' ? 'selected' : ''); ?>>🚗 Transportation</option>
                                            <option value="Other" <?php echo e(old('type') == 'Other' ? 'selected' : ''); ?>>📋 Other</option>
                                        </select>
                                        <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="cs_invalid_feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <small class="form-hint">
                                            <i class="fas fa-info-circle"></i> Select the category
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-field-wrapper">
                                        <label for="quantity" class="form-label-improved">
                                            <i class="fas fa-hashtag"></i> Quantity <span class="text-danger">*</span>
                                        </label>
                                        <input type="number"
                                               class="form-input-improved <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               id="quantity"
                                               name="quantity"
                                               value="<?php echo e(old('quantity', 1)); ?>"
                                               min="1"
                                               placeholder="Enter quantity"
                                               required>
                                        <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="cs_invalid_feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <small class="form-hint">
                                            <i class="fas fa-info-circle"></i> How many units?
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Notes -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-field-wrapper">
                                        <label for="description" class="form-label-improved">
                                            <i class="fas fa-sticky-note"></i> Additional Notes <small class="text-muted">(Optional)</small>
                                        </label>
                                        <textarea class="form-textarea-improved <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                  id="description"
                                                  name="description"
                                                  rows="6"
                                                  placeholder="Add any additional details about this resource, delivery conditions, or special requirements..."><?php echo e(old('description')); ?></textarea>
                                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="cs_invalid_feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <small class="form-hint">
                                            <i class="fas fa-info-circle"></i> Maximum 500 characters
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions-section">
                                <a href="<?php echo e(route('events.show', $event->id)); ?>" class="btn-cancel-beautiful">
                                    <i class="fas fa-times-circle"></i> Cancel
                                </a>
                                <button type="submit" class="btn-submit-beautiful">
                                    <i class="fas fa-plus-circle"></i> Add Resource to Event
                                    <span class="btn-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Improved Form Styles -->
                    <style>
                        .resource-form-card {
                            background: white;
                            border-radius: 14px;
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08), 0 4px 16px rgba(0, 0, 0, 0.06);
                            overflow: hidden;
                            transition: all 0.3s ease;
                        }

                        .form-header-section {
                            display: flex;
                            align-items: center;
                            gap: 14px;
                            padding: 22px 28px;
                            background: linear-gradient(135deg, #f0fdf4 0%, #e8f5e9 100%);
                            border-bottom: 2px solid #c8e6c9;
                        }

                        .form-header-icon {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            width: 40px;
                            height: 40px;
                            background: #4CAF50;
                            color: white;
                            border-radius: 10px;
                            font-size: 18px;
                            box-shadow: 0 2px 8px rgba(76, 175, 80, 0.2);
                        }

                        .form-header-title {
                            margin: 0;
                            font-size: 18px;
                            font-weight: 700;
                            color: #1a3a1a;
                            letter-spacing: 0.4px;
                        }

                        .form-content {
                            padding: 32px 28px;
                        }

                        .form-field-wrapper {
                            display: flex;
                            flex-direction: column;
                            gap: 8px;
                        }

                        .form-label-improved {
                            display: flex;
                            align-items: center;
                            gap: 8px;
                            font-size: 14px;
                            font-weight: 700;
                            text-transform: uppercase;
                            color: #2d3748;
                            letter-spacing: 0.5px;
                        }

                        .form-label-improved i {
                            color: #4CAF50;
                            font-size: 15px;
                        }

                        .form-input-improved,
                        .form-select-improved {
                            padding: 16px 18px;
                            font-size: 15px;
                            font-weight: 500;
                            color: #2d3748;
                            background: #ffffff;
                            border: 2px solid #e2e8f0;
                            border-radius: 10px;
                            transition: all 0.3s ease;
                            outline: none;
                            min-height: 54px;
                        }

                        .form-input-improved::placeholder,
                        .form-select-improved {
                            color: #a0aec0;
                            font-weight: 400;
                        }

                        .form-input-improved:focus,
                        .form-select-improved:focus {
                            border-color: #4CAF50;
                            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.1);
                            background-color: #fafafa;
                        }

                        .form-input-improved:hover:not(:focus),
                        .form-select-improved:hover:not(:focus) {
                            border-color: #cbd5e0;
                            background-color: #fbfcfd;
                        }

                        .form-textarea-improved {
                            padding: 16px 18px;
                            font-size: 14px;
                            font-weight: 500;
                            color: #2d3748;
                            background: #ffffff;
                            border: 2px solid #e2e8f0;
                            border-radius: 10px;
                            transition: all 0.3s ease;
                            outline: none;
                            font-family: inherit;
                            resize: vertical;
                            min-height: 140px;
                        }

                        .form-textarea-improved::placeholder {
                            color: #a0aec0;
                            font-weight: 400;
                        }

                        .form-textarea-improved:focus {
                            border-color: #4CAF50;
                            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.1);
                            background-color: #fafafa;
                        }

                        .form-textarea-improved:hover:not(:focus) {
                            border-color: #cbd5e0;
                            background-color: #fbfcfd;
                        }

                        .form-hint {
                            font-size: 12px;
                            color: #718096;
                            display: flex;
                            align-items: center;
                            gap: 4px;
                            padding-top: 2px;
                        }

                        .form-hint i {
                            color: #cbd5e0;
                        }

                        .form-actions-section {
                            display: flex;
                            align-items: center;
                            gap: 16px;
                            margin-top: 36px;
                            padding-top: 28px;
                            border-top: 2px solid #e2e8f0;
                        }

                        /* Beautiful Cancel Button */
                        .btn-cancel-beautiful {
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            gap: 10px;
                            padding: 12px 28px;
                            font-size: 15px;
                            font-weight: 600;
                            color: #64748b;
                            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
                            border: 2px solid #cbd5e0;
                            border-radius: 10px;
                            text-decoration: none;
                            transition: all 0.3s ease;
                            cursor: pointer;
                            min-height: 48px;
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                        }

                        .btn-cancel-beautiful:hover {
                            color: #475569;
                            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
                            border-color: #94a3b8;
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                            transform: translateY(-2px);
                        }

                        .btn-cancel-beautiful:active {
                            transform: translateY(0);
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                        }

                        .btn-cancel-beautiful i {
                            font-size: 16px;
                        }

                        /* Beautiful Submit Button */
                        .btn-submit-beautiful {
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            gap: 10px;
                            padding: 12px 32px;
                            font-size: 15px;
                            font-weight: 700;
                            color: white;
                            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
                            border: none;
                            border-radius: 10px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                            min-height: 48px;
                            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
                            margin-left: auto;
                        }

                        .btn-submit-beautiful:hover {
                            background: linear-gradient(135deg, #45a049 0%, #3d8b40 100%);
                            box-shadow: 0 6px 16px rgba(76, 175, 80, 0.4);
                            transform: translateY(-2px);
                        }

                        .btn-submit-beautiful:active {
                            transform: translateY(0);
                            box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);
                        }

                        .btn-submit-beautiful:disabled {
                            opacity: 0.6;
                            cursor: not-allowed;
                            transform: none;
                        }

                        .btn-arrow {
                            display: inline-flex;
                            align-items: center;
                            font-size: 12px;
                            transition: transform 0.3s ease;
                        }

                        .btn-submit-beautiful:hover .btn-arrow {
                            transform: translateX(3px);
                        }

                        /* Mobile Responsive */
                        @media (max-width: 768px) {
                            .form-content {
                                padding: 24px 20px;
                            }

                            .form-header-section {
                                padding: 18px 20px;
                            }

                            .form-actions-section {
                                flex-direction: column-reverse;
                                gap: 12px;
                            }

                            .btn-cancel-beautiful,
                            .btn-submit-beautiful {
                                width: 100%;
                                margin-left: 0;
                            }

                            .form-input-improved,
                            .form-select-improved,
                            .form-textarea-improved {
                                font-size: 14px;
                                padding: 14px 16px;
                                min-height: 48px;
                            }

                            .form-textarea-improved {
                                min-height: 120px;
                            }
                        }

                        @media (max-width: 480px) {
                            .form-header-icon {
                                width: 36px;
                                height: 36px;
                                font-size: 16px;
                            }

                            .form-header-title {
                                font-size: 16px;
                            }

                            .form-label-improved {
                                font-size: 13px;
                            }
                        }
                    </style>

                    <!-- Helper Tips -->












                </div>
            </div>
        </div>
        <div class="cs_height_150 cs_height_lg_80"></div>
    </section>
    <!-- End Add Resource Section -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('resourceForm');

            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding Resource...';
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontOffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/pages/resource/add-resource.blade.php ENDPATH**/ ?>