

<?php $__env->startSection('title', __('messages.privacy.page.title')); ?>
<?php $__env->startSection('description', __('messages.privacy.page.description')); ?>

<?php $__env->startSection('content'); ?>
<section class="section-padding" style="background: white; margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="fade-in legal-content">
                    <h1>Politique de Confidentialité – Données Personnelles (RGPD)</h1>

                    <p>
                        Conformément au Règlement (UE) 2016/679 du 27 avril 2016 (RGPD) et à la loi Informatique et Libertés modifiée, cette politique de confidentialité informe les utilisateurs du site de la manière dont leurs données personnelles sont collectées, utilisées et protégées.
                    </p>

                    <h2>1. Responsable du traitement</h2>
                    <p>
                        Le responsable du traitement est : ssjchrysalide<br>
                        Fort-de-France 97200 Martinique<br>
                        Contact : <a href="http://ssjchrysalide.com/fr/contact" target="_blank" rel="noopener">http://ssjchrysalide.com/fr/contact</a>.
                    </p>

                    <h2>2. Données collectées</h2>
                    <p>Dans le cadre de l’utilisation du site et des services proposés (formulaire de contact, prise de rendez-vous, etc.), les données suivantes peuvent être collectées :</p>
                    <ul>
                        <li>Nom, prénom</li>
                        <li>Adresse e-mail</li>
                        <li>Numéro de téléphone</li>
                        <li>Informations nécessaires à la gestion des rendez-vous et du suivi des accompagnements</li>
                        <li>Éventuellement des informations transmises volontairement par l’utilisateur lors des échanges (hors données médicales)</li>
                    </ul>

                    <h2>3. Finalités du traitement</h2>
                    <p>Les données collectées sont utilisées uniquement pour :</p>
                    <ul>
                        <li>Gérer les demandes de contact et de rendez-vous ;</li>
                        <li>Assurer le suivi administratif des séances et ateliers ;</li>
                        <li>Informer sur les services proposés et les actualités du cabinet (avec consentement explicite).</li>
                    </ul>

                    <h2>4. Base légale du traitement</h2>
                    <p>Le traitement repose sur :</p>
                    <ul>
                        <li>L’exécution d’un contrat ou de mesures précontractuelles (prise de rendez-vous, suivi) ;</li>
                        <li>Le consentement explicite de la personne concernée pour toute communication d’information ;</li>
                        <li>L’intérêt légitime du praticien pour la gestion de son activité professionnelle.</li>
                    </ul>

                    <h2>5. Durée de conservation</h2>
                    <p>Les données sont conservées pour une durée maximale de trois (3) ans après le dernier contact, sauf obligation légale de conservation plus longue ou suppression demandée par l’utilisateur.</p>

                    <h2>6. Droits des utilisateurs</h2>
                    <p>Conformément au RGPD, vous disposez des droits suivants :</p>
                    <ul>
                        <li>Droit d’accès, de rectification et d’effacement ;</li>
                        <li>Droit d’opposition et de limitation du traitement ;</li>
                        <li>Droit à la portabilité des données ;</li>
                        <li>Droit de retirer votre consentement à tout moment.</li>
                    </ul>

                    <p>Pour exercer vos droits, vous pouvez adresser une demande directement sur le site : <a href="http://ssjchrysalide.com/fr/contact" target="_blank" rel="noopener">http://ssjchrysalide.com/fr/contact</a>.</p>

                    <h2>7. Sécurité des données</h2>
                    <p>Le site met en œuvre des mesures techniques et organisationnelles adaptées pour assurer la sécurité et la confidentialité des données personnelles, notamment contre tout accès non autorisé, perte ou divulgation.</p>

                    <h2>8. Cookies</h2>
                    <p>Le site peut utiliser des cookies à des fins de fonctionnement, de mesure d’audience ou de navigation facilitée. L’utilisateur peut à tout moment configurer son navigateur pour accepter, refuser ou supprimer les cookies.</p>

                    <h2>9. Réclamation</h2>
                    <p>En cas de difficulté relative à la gestion de vos données personnelles, vous pouvez introduire une réclamation auprès de la Commission Nationale de l’Informatique et des Libertés (CNIL) – <a href="https://www.cnil.fr" target="_blank" rel="noopener">www.cnil.fr</a>.</p>

                    <h2>10. Contact</h2>
                    <p>Pour toute question relative à cette politique de confidentialité, vous pouvez adresser une demande directement sur le site : <a href="http://ssjchrysalide.com/fr/contact" target="_blank" rel="noopener">http://ssjchrysalide.com/fr/contact</a>.</p>

                    <p class="text-muted mt-4"><small>Dernière mise à jour : <?php echo e(date('d/m/Y')); ?></small></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .legal-content { font-size: 1.05rem; line-height: 1.8; }
    .legal-content h1 { font-size: 2rem; margin-bottom: 1rem; }
    .legal-content h2 { margin-top: 1.5rem; margin-bottom: .75rem; font-size: 1.25rem; }
    .legal-content ul { margin-left: 1.25rem; }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/privacy-policy.blade.php ENDPATH**/ ?>