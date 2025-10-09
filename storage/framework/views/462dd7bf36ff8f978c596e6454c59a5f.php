

<?php $__env->startSection('title', __('messages.terms.page.title')); ?>
<?php $__env->startSection('description', __('messages.terms.page.description')); ?>

<?php $__env->startSection('content'); ?>
<section class="section-padding" style="background: white; margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="fade-in legal-content">
                    <h1>Conditions Générales de Vente et d’Utilisation</h1>

                    <h2>1. Présentation</h2>
                    <p>
                        Le présent site est édité par : ssjchrysalide<br>
                        Siège professionnel : Fort-de-France 97200, Martinique<br>
                        L’hébergement du présent site est assuré par OVH SAS
                    </p>

                    <h2>2. Objet</h2>
                    <p>
                        Les présentes Conditions Générales définissent les modalités de réservation, de paiement et de déroulement des séances individuelles ou ateliers de groupe proposés par ssjchrysalide, ainsi que les droits et obligations des deux parties. Toute prise de rendez-vous ou inscription à un atelier implique l’acceptation sans réserve des présentes conditions.
                    </p>

                    <h2>3. Nature des prestations</h2>
                    <p>
                        ssjchrysalide propose :
                    </p>
                    <ul>
                        <li>Des séances individuelles de sophrologie, hypnose ou PNL ;</li>
                        <li>Des ateliers de groupe à destination des particuliers ou des entreprises.</li>
                    </ul>
                    <p>
                        Les prestations proposées sont des accompagnements de bien-être et de développement personnel, et ne se substituent en aucun cas à un suivi médical ou psychologique.
                    </p>

                    <h2>4. Prise de rendez-vous</h2>
                    <p>
                        Les rendez-vous peuvent être pris par téléphone, e-mail ou via le formulaire de contact du site. Toute réservation est confirmée par message ou e-mail.
                    </p>

                    <h2>5. Tarifs et paiement</h2>
                    <p>
                        Les tarifs sont indiqués en euros (€), toutes taxes comprises (TVA non applicable, art. 293B du CGI).
                    </p>
                    <p>
                        Le tarif d’une séance individuelle varie entre 70€ et 80€ en fonction de la pratique et de la durée de la séance.
                    </p>
                    <p>
                        Pour les accompagnements personnalisés ou multi-pratiques (Sophrologie, Hypnose, PNL), le tarif global dépend du nombre et de la fréquence des séances, définis ensemble selon vos besoins lors du premier rendez-vous.
                    </p>
                    <p>
                        Une estimation claire et transparente est toujours proposée avant le démarrage du suivi.
                    </p>
                    <p>
                        Le paiement s’effectue en espèces, par chèque, virement, ou tout autre moyen convenu à l’avance.
                    </p>

                    <h2>6. Annulation et report</h2>
                    <p>
                        Toute séance annulée moins de 24 heures à l’avance est considérée comme due, sauf cas de force majeure. Toute demande de report doit être signalée le plus tôt possible.
                    </p>
                    <p>
                        L’intervenante se réserve le droit d’annuler ou de reporter une séance ou un atelier en cas d’imprévu, de force majeure ou de nombre insuffisant de participants.
                    </p>

                    <h2>7. Données personnelles</h2>
                    <p>
                        Les données collectées (nom, prénom, téléphone, e-mail) sont utilisées uniquement pour la gestion des rendez-vous, le suivi des séances et la communication avec les clients. Ces données sont confidentielles et ne sont jamais transmises à des tiers sans accord préalable.
                    </p>
                    <p>
                        Conformément au Règlement Général sur la Protection des Données (RGPD – UE 2016/679), le client dispose d’un droit d’accès, de rectification, de suppression et d’opposition sur les données le concernant. Toute demande peut être adressée directement sur le site <a href="http://ssjchrysalide.com/fr/contact" target="_blank" rel="noopener">http://ssjchrysalide.com/fr/contact</a>.
                    </p>

                    <h2>8. Responsabilité</h2>
                    <p>
                        Les séances et ateliers proposés ne relèvent ni du domaine médical, ni du domaine psychologique. Ils constituent un accompagnement complémentaire, centré sur le bien-être et le développement personnel. L’intervenante ne saurait être tenue responsable de toute décision personnelle, médicale ou professionnelle prise par le client à la suite des séances.
                    </p>

                    <h2>9. Propriété intellectuelle</h2>
                    <p>
                        Tous les contenus présents sur le site (textes, images, supports d’exercices, logos) sont la propriété exclusive de ssjchrysalide et sont protégés par le droit d’auteur. Toute reproduction ou diffusion, même partielle, sans autorisation préalable est interdite.
                    </p>

                    <h2>10. Droit applicable et juridiction compétente</h2>
                    <p>
                        Les présentes conditions sont régies par le droit français. Tout litige relatif à leur interprétation ou exécution relève de la compétence exclusive des tribunaux de Fort-de-France (Martinique).
                    </p>

                    <h2>11. Contact</h2>
                    <p>
                        Pour toute question relative aux présentes conditions, vous pouvez faire une demande d’information directement sur le site <a href="http://ssjchrysalide.com/fr/contact" target="_blank" rel="noopener">http://ssjchrysalide.com/fr/contact</a>.
                    </p>

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
    .legal-content h2 { margin-top: 1.25rem; margin-bottom: .75rem; font-size: 1.25rem; }
    .legal-content ul { margin-left: 1.25rem; }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/terms-conditions.blade.php ENDPATH**/ ?>