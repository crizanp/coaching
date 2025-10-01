<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($type === 'confirmed' ? 'Confirmation' : ($type === 'cancelled' ? 'Annulation' : 'Mise à jour')); ?> de votre inscription</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f8f9fa;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 30px 20px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 28px;
            font-weight: 300;
            margin-bottom: 10px;
        }
        
        .header p {
            font-size: 16px;
            opacity: 0.9;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .status-confirmed {
            background: #d4edda;
            color: #155724;
        }
        
        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        
        .status-waitlist {
            background: #fff3cd;
            color: #856404;
        }
        
        .event-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
        }
        
        .event-title {
            font-size: 22px;
            font-weight: 600;
            color: #667eea;
            margin-bottom: 15px;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 10px;
            align-items: center;
        }
        
        .detail-label {
            font-weight: 600;
            color: #555;
            width: 120px;
            flex-shrink: 0;
        }
        
        .detail-value {
            color: #333;
        }
        
        .message {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
        }
        
        .footer {
            background: #f8f9fa;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        
        .footer p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .contact-info {
            color: #667eea;
            font-weight: 500;
        }
        
        @media (max-width: 600px) {
            .container {
                margin: 10px;
                border-radius: 8px;
            }
            
            .content {
                padding: 30px 20px;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .detail-label {
                width: auto;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>
                <?php if($type === 'confirmed'): ?>
                    ✓ Inscription Confirmée
                <?php elseif($type === 'cancelled'): ?>
                    ✗ Inscription Annulée
                <?php elseif($type === 'waitlist'): ?>
                    ⏳ Liste d'Attente
                <?php else: ?>
                    📧 Mise à Jour
                <?php endif; ?>
            </h1>
            <p><?php echo e($event->getTranslation('title', 'fr')); ?></p>
        </div>

        <!-- Content -->
        <div class="content">
            <p style="font-size: 16px; margin-bottom: 20px;">Bonjour <?php echo e($application->name); ?>,</p>

            <!-- Status Badge -->
            <div class="status-badge status-<?php echo e($type); ?>">
                <?php if($type === 'confirmed'): ?>
                    Inscription confirmée
                <?php elseif($type === 'cancelled'): ?>
                    Inscription annulée
                <?php elseif($type === 'waitlist'): ?>
                    Placé en liste d'attente
                <?php else: ?>
                    Statut mis à jour
                <?php endif; ?>
            </div>

            <!-- Message based on type -->
            <?php if($type === 'confirmed'): ?>
                <p>Nous avons le plaisir de confirmer votre inscription à notre atelier. Nous vous remercions de votre intérêt et nous réjouissons de vous accueillir.</p>
            <?php elseif($type === 'cancelled'): ?>
                <p>Nous regrettons de vous informer que votre inscription a été annulée. Si vous avez des questions, n'hésitez pas à nous contacter.</p>
            <?php elseif($type === 'waitlist'): ?>
                <p>Votre inscription a été placée en liste d'attente car l'atelier est complet. Nous vous contacterons dès qu'une place se libère.</p>
            <?php else: ?>
                <p>Le statut de votre inscription a été mis à jour. Veuillez trouver ci-dessous les détails actualisés.</p>
            <?php endif; ?>

            <!-- Event Details -->
            <div class="event-details">
                <div class="event-title"><?php echo e($event->getTranslation('title', 'fr')); ?></div>
                
                <?php if($event->getTranslation('description', 'fr')): ?>
                    <p style="margin-bottom: 20px; color: #666;"><?php echo e($event->getTranslation('description', 'fr')); ?></p>
                <?php endif; ?>

                <div class="detail-row">
                    <span class="detail-label">Type :</span>
                    <span class="detail-value"><?php echo e(ucfirst($event->type ?: 'Atelier')); ?></span>
                </div>

                <?php if($event->event_date): ?>
                    <div class="detail-row">
                        <span class="detail-label">Date :</span>
                        <span class="detail-value"><?php echo e($event->event_date->format('d/m/Y à H:i')); ?></span>
                    </div>
                <?php endif; ?>

                <?php if($event->duration): ?>
                    <div class="detail-row">
                        <span class="detail-label">Durée :</span>
                        <span class="detail-value"><?php echo e($event->duration); ?></span>
                    </div>
                <?php endif; ?>

                <?php if($event->getTranslation('location', 'fr')): ?>
                    <div class="detail-row">
                        <span class="detail-label">Lieu :</span>
                        <span class="detail-value"><?php echo e($event->getTranslation('location', 'fr')); ?></span>
                    </div>
                <?php endif; ?>

                <?php if($event->price): ?>
                    <div class="detail-row">
                        <span class="detail-label">Prix :</span>
                        <span class="detail-value">€<?php echo e(number_format((float)$event->price, 2)); ?></span>
                    </div>
                <?php else: ?>
                    <div class="detail-row">
                        <span class="detail-label">Prix :</span>
                        <span class="detail-value">Sur devis</span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Workshop Content -->
            <?php if($event->getTranslation('content', 'fr') && $type === 'confirmed'): ?>
                <div class="message">
                    <h3 style="margin-bottom: 15px; color: #1976d2;">À propos de cet atelier :</h3>
                    <div style="white-space: pre-line;"><?php echo e($event->getTranslation('content', 'fr')); ?></div>
                </div>
            <?php endif; ?>

            <!-- Additional Notes -->
            <?php if($application->notes && $type === 'confirmed'): ?>
                <div class="message">
                    <h3 style="margin-bottom: 15px; color: #1976d2;">Note importante :</h3>
                    <p><?php echo e($application->notes); ?></p>
                </div>
            <?php endif; ?>

            <!-- Next Steps -->
            <?php if($type === 'confirmed'): ?>
                <div style="margin-top: 30px;">
                    <h3 style="color: #667eea; margin-bottom: 15px;">Prochaines étapes :</h3>
                    <ul style="padding-left: 20px; color: #555;">
                        <li>Gardez cet email comme confirmation de votre inscription</li>
                        <li>Notez la date et l'heure de l'atelier dans votre calendrier</li>
                        <?php if($event->registration_deadline): ?>
                            <li>Si vous devez annuler, merci de nous prévenir avant le <?php echo e($event->registration_deadline->format('d/m/Y')); ?></li>
                        <?php endif; ?>
                        <li>N'hésitez pas à nous contacter si vous avez des questions</li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre directement.</p>
            <p>Pour toute question, contactez-nous :</p>
            <p class="contact-info">
                📧 info@coaching-example.com<br>
                📞 +596 XX XX XX XX
            </p>
        </div>
    </div>
</body>
</html><?php /**PATH D:\client-fiverr\coaching\resources\views/emails/event-confirmation.blade.php ENDPATH**/ ?>