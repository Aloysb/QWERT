<?php require APPROOT.'/views/inc/header.php'; ?>
<?php 
if (isset($data['data_accounting'])){
    $data = $data['data_accounting'];
}
?>
<!--::header part start::-->
<header id="navbar__compta" class="head" role="banner">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="/index.html">
            <img src="/assets/images_proto/logo.jpeg" alt="Logo" class="logo-img" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHome" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg></button>
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarHome">
            <div class="navbar-nav">
                <ul class="menu">
                    <li class="login-btn btn">
                        <a href='/pages/connexion'>
                            <button class="btn">
                                <?php if(isLoggedIn()){ 
                                echo'Retour aux fiches';
                            } else {
                                echo 'Se connecter';
                            };
                            ?></button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main id="faq__compta">
    <div class="blop blop__one">
        <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" width="100%" id="blobSvg">
            <path id="blob" d="M335.5,348Q250,446,140.5,348Q31,250,140.5,142.5Q250,35,335.5,142.5Q421,250,335.5,348Z" fill="#0095d9"></path>
        </svg>
    </div>
    <div class="blop blop__two">
        <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" width="100%" id="blobSvg">
            <path id="blob" d="M317.5,328.5Q159,407,156.5,245.5Q154,84,315,167Q476,250,317.5,328.5Z" fill="#0095d9"></path>
        </svg>
    </div>
    <div class="container container-faq text-center">
        <div class="card p-6">
            <div class='row'>
                <div class="col-sm-12 col-md-6 d-flex justify-content-start align-items-center">
            <h1>Comptabilité - F.A.Q. </h1>
        </div>
                <div class="col-sm-12 col-md-6 d-flex justify-content-end align-items-center">
            <a class="return__btn" href="/pages/comptabilite"><i class="fa fa-chevron-left"></i> Retour à l'outil de comptabilité</a>
            </div>
            </div>
            <div class='row'>
                <div class="col-sm-12 col-md-4 d-flex justify-content-start align-items-start">
                    <p class="maj" >Mis à jour le 03/09/20 par Doctofiche.</p>
                </div>
                   <div class="col-sm-12 col-md-8 d-flex justify-content-end pt-3 d-flex align-items-end flex-column">
                    <p class="mb-0 pb-2 text-secondary font-italic">Pour toutes questions supplémentaires, contactez notre expert comptable:</p>
                    <div class="d-flex align-items-center flex-column mr-5 mt-2">
                    <p class="mb-0 pb-0 text-secondary font-weight-bold">Bruno Encoua</p>
                    <p class="mb-0 pb-0 text-secondary font-italic font-weight-light">Expert comptable</p>
                    <p class="mb-0 pb-0 text-secondary font-italic font-weight-light">Commissaire aux comptes</p>
                        <p class="mb-0 pb-0 text-secondary  mt-1">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>bruno.encaoua@orange.fr</p>
                </div>
                </div>
            </div>
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOnhis)">
                                    <svg class = 'chevron' xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                S’inscrire à l’URSSAF
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <h2 style="padding-top: 15px; padding-bottom: 10px">Quand ?</h2>

Au plus tard, <b><u>8 jours</u></b> après avoir débuté une activité́ libérale.<br /><br />

Que vous ayez par ailleurs une activité́ salariée ou non, que vous soyez thésé ou non, vous devez vous immatriculer auprès de l’URSSAF et payer des cotisations sociales (cotisations maladie, allocations familiales, etc.) dès lors que vous exercez une activité́ libérale.

<h2 style="padding-top: 15px; padding-bottom: 10px">Où ?</h2>

Dans le département de votre <b><u>lieu de résidence</u></b> si vous êtes remplaçant, dans le département de votre <b><u>lieu d’exercice</u></b> si vous êtes installé ou collaborateur libéral (de votre cabinet principal si vous avez plusieurs lieux d’exercice).<br /><br />

Les adresses des Urssaf sont disponibles ici :<br /><br />

<a target="_blank" href="https://www.urssaf.fr/portail/home/votre-urssaf.html"><b><u>https://www.urssaf.fr/portail/home/votre-urssaf.html</u></b></a><br /><br />

Vous recevrez ensuite un <b>courrier de l’INSEE</b> avec vos numéros d’immatriculation <b>SIREN et SIRET.</b>

<h2 style="padding-top: 15px; padding-bottom: 10px">Comment ?</h2>

En remplissant le formulaire de déclaration de début d’activité <b>P0PL</b>, soit en le récupérant auprès de votre Urssaf, soit en le téléchargeant sur le net : <a target="_blank" href="https://www.formulaires.modernisation.gouv.fr/gf/cerfa_11768.do"><u><br /><br />https://www.formulaires.modernisation.gouv.fr/gf/cerfa_11768.do</u></a><br /><br />

Vous pouvez faire votre déclaration en ligne sur : <a target="_blank" href="https://www.cfe.urssaf.fr/unsecure_index.jsp"><u>https://www.cfe.urssaf.fr/unsecure_index.jsp</u></a><br /><br />

En cas de modification de votre activité (installation, déménagement, etc.), il faut le signaler le plus rapidement à votre Urssaf en remplissant le formulaire <b><u>P2PL</u></b>.<br /><br />

Depuis peu, certaines CPAM proposent d’effectuer pour vous les démarches de déclaration de début d’activité, à l’occasion d’un rendez-vous qui s’effectue avant votre premier remplacement. Renseignez-vous auprès de la vôtre !
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                               <svg class = 'chevron' xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                               Avoir une AGA : pourquoi ? quand adhérer ? 
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <h2 style="padding-top: 15px; padding-bottom: 10px">Pourquoi ?</h2>
                            <ul>
<li>Éviter la majoration de 25 % applicable aux non-adhérents d’AGA / OMGA et servant à neutraliser les effets d’aubaine nés de la refonte du barème de l’impôt sur le revenu (sur 100 € déclarés, le non adhérent est taxé sur 125 €)</li>

<li>Bénéficier d’une réduction d’impôt, en cas d’option pour la déclaration 2035 (recettes et dépenses) et de recettes inférieures au seuil du régime micro-BNC. Dans la limite de 915 €, l’impôt sur le revenu est réduit des deux tiers du montant de la cotisation à l’AGA / OMGA et des dépenses exposées pour la tenue de la comptabilité. La réduction d’impôt s’impute sur le montant de l’impôt sur le revenu dans la limite de son montant, et ne peut pas entraîner une restitution d’impôt.</li>

<li>Bénéficier de la déduction de l’abattement conventionnel de 3 % en cumul avec les autres abattements spécifiques au secteur I, applicables aux seuls médecins conventionnés, au titre de leur première année d’adhésion à l’AGA / OMGA.</li>
</ul>
<h2 style="padding-top: 15px; padding-bottom: 10px">Quand ? Choisir la meilleure date pour adhérer</h2>

Si vous commencez votre activité : il faut vous inscrire dans les <u><b>5 mois</b></u> du début de l’activité.<br /><br />

Si c’est une première adhésion à une AGA / OMGA, vous devez adhérer avant le 1er juin de l’année au titre de laquelle les avantages fiscaux sont sollicités (jusqu'au 31 décembre en cas de première adhésion à une AGA / OMGA si vous avez franchi les limites de chiffres d'affaires du régime micro-BNC).<br /><br />

Lors d’une reprise d’une activité après cessation : dans les <b><u>5 mois de la reprise d’activité.</u></b><br /><br />

En cas de transfert volontaire d’une AGA / OMGA vers une autre : vous devez adhérer dans un délai maximum de 30 jours qui suivent la date de votre démission volontaire de votre précédente association.<br /><br />

Dans les autres situations, toute la période d'imposition doit être couverte par l'adhésion.<br /><br />
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <svg class = 'chevron' xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                Qui cotise à la CARMF ?
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <h2 style="padding-top: 15px; padding-bottom: 10px">Affiliation :</h2>

L’affiliation est <u><b>obligatoire</b></u> pour les médecins titulaires du diplôme de docteur en médecine, inscrits au conseil de l’Ordre et exerçant une activité libérale (installation, remplacements, secteur privé à l’hôpital, en société d’exercice libéral ou toute autre activité rémunérée sous forme d’honoraires, même s’il ne s’agit pas de la médecine de soins) en France métropolitaine et dans les départements d’Outre-Mer ou à Monaco.

<h2 style="padding-top: 15px; padding-bottom: 10px">Quand et comment vous déclarer ?</h2>

Vous devez faire votre déclaration à la CARMF dans <u><b>le mois qui suit le début de votre activité</b></u> libérale. Votre affiliation est prononcée au premier jour du trimestre civil suivant le début de l’exercice non salarié.

<h2 style="padding-top: 15px; padding-bottom: 10px">Vos cotisations :</h2>

Vous cotisez aux régimes suivants :
<ul>

<li>Trois régimes de retraite :</li>
<ul>
    <li><b>Régime de base :</b></li>

<p>Fonctionne en points et trimestres d’assurance, une partie des cotisations des médecins en secteur 1 est prise en charge par les caisses maladies ;</p>

<li><b>Régime complémentaire vieillesse :</b></li>

<p>Géré en répartition provisionnée et fonctionne en points ;</p>

<li><b>Régime des allocations supplémentaires de vieillesse (ASV)</b>, si vous êtes conventionné. Il fonctionne en points. Les deux tiers de la cotisation des médecins en secteur 1 sont financés par les caisses maladie.</li>
</ul>

<li>Un régime de prévoyance</li>

<li>Régime invalidité-décès.</li>

<li>Un régime facultatif</li>

<ul>
    <li>Régime facultatif Capimed : retraite gérée en capitalisation dans le cadre de la loi Madelin</li>
</ul>
</ul>

<h2 style="padding-top: 15px; padding-bottom: 10px">Médecin remplaçant :</h2>

Si vous êtes médecin remplaçant, régulateur dans le cadre de la permanence des soins ou si vous exercez une activité limitée à des expertises, vous pouvez demander la dispense d’affiliation à condition de ne pas être assujetti à la contribution économique territoriale et d’avoir un revenu net d'activité indépendante inférieur à 12 500 €.<br /><br />

Attention, cette dispense n’est pas automatique et doit être demandée.<br /><br />

Dans ce cas, la période durant laquelle vous aurez effectué vos activités sans avoir demandé votre affiliation à notre organisme, ne sera jamais prise en compte pour le décompte des trimestres d’assurance au régime de base et le calcul de vos droits aux régimes de retraite.<br /><br />

Si les conditions de dispense d’affiliation ci-dessus ne sont pas réunies, votre affiliation est prononcée.<br /><br />

<h2 style="padding-top: 15px; padding-bottom: 10px">Remplaçants non thésés :</h2>

L’article 25 de la loi de financement de la Sécurité sociale pour 2018 a introduit le principe de l'affiliation obligatoire à la CARMF des étudiants en médecine effectuant des remplacements libéraux (article L. 640-1 du code de la Sécurité sociale), et ce à compter du 1er janvier 2018.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour"">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <svg class = 'chevron' xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                Impôt
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <h2 style="padding-top: 15px; padding-bottom: 10px">Affiliation :</h2>

<u>2 Type de régimes existent :</u><br/>
<ul>

<li><b>Micro BNC (= « non contrôlée ») :</b></li>
<br /><br />
Il s'agit des professions médicales et paramédicales, des avocats, des notaires, etc. Les personnes physiques soumises à ce régime sont taxées sur leur chiffre d'affaires. Le chiffre d’affaires est plafonné à 72 500 €. Ce chiffre d'affaires est soumis à l'impôt sur le revenu après application d'un abattement de 34%. Cet abattement, représentatif des frais professionnels, s’applique au montant total des recettes réalisées.<br /><br />

</ul>

<h2 style="padding-top: 15px; padding-bottom: 10px">Comment déclarer ses revenus au micro-BNC ?</h2>

Avec le micro-BNC, les obligations déclaratives sont simplifiées. Chaque année, pendant le 2e trimestre, les professionnels doivent déclarer leurs recettes :
<ul>

<li>À la demande de l’URSSAF : en remplissant la Déclaration Sociale des Indépendants (DSI) sur le <b><u>site net-entreprises.fr</u></b></li>

<li>Sur la déclaration d’impôt sur le revenu 2042 C-PRO : > Revenus non commerciaux professionnels > Régime déclaratif spécial ou micro BNC > Revenus imposables = Total des recettes</li><br /><br />

<u><b>Important</b></u> : le montant déclaré est le montant <b><u>brut</u></b>. Vous n'avez pas à calculer et à déduire vous-même l'abattement de 34%.

Les recettes à comptabiliser pour le micro-BNC comprennent :

<ul>
<li>Les honoraires</li>

<li>Les remplacements de revenus (congés maternité / paternité, etc.)</li>

<li>Les indemnités journalières</li>

<li>Les avantages en nature</li>

<li>Et les subventions perçus dans le cadre de l’activité libérale.</li>
</ul>
<br /><br />
Sur le plan déclaratif, le micro-BNC est relativement simple. Les professions libérales assujetties à ce régime doivent reporter le montant de leur chiffre d'affaires doit être porté sur leur déclaration de revenus <u><b>2042-C PRO</b></u> dans la case <u><b>5HQ</b></u> de la catégorie "Revenus Non Commerciaux Professionnels", rubrique "Régime déclaratif spécial ou micro BNC" :<br /></br />
<ul>

    <div style="margin: auto; width: 75%">
<img src="/assets/FAQ_compta/FAQ_compta_1.png" style="width:100%"/>
</div>

<li>BNC (= « contrôlée ») :</li>

Ceci correspond au régime réel d'imposition. Cette option est ouverte pour les professionnels au micro-BNC mais elle s'applique de plein droit si :
<ul>

<li>Vous avez réalisé plus de 70 000 € de chiffre d'affaires annuels (en 2019) ;</li>

<li>Vous n'entrez pas dans le champ d'application du régime micro-BNC.</li>

</ul>
</ul>
<br /><br />
Dans ce cas, le bénéfice est calculé sur l'exercice comptable, qui correspond à l'année civile. Avec la déclaration contrôlée, <b><u>pas d'abattement forfaitaire qui tienne</u></b> : le professionnel <b><u>déduit lui-même les charges supportées</u></b> (dans le cadre de son activité) de ses recettes encaissées. En termes d'obligations comptables, le régime de la déclaration contrôlée est plus contraignant que le micro-BNC. On conseille aux professionnels soumis à ce régime de tenir une comptabilité de trésorerie.<br /><br />

Avec la déclaration contrôlée (=BNC), vous <u><b>déduisez vos dépenses réelles</b></u>. Vous avez tout intérêt à choisir le régime de la déclaration contrôlée si la valeur réelle de vos dépenses est plus importante que la valeur forfaitaire de 34% appliquée pour le régime micro-BNC.<br /><br />

Les contribuables qui relèvent de la catégorie des bénéfices non commerciaux (BNC) et sont soumis au régime déclaratif spécial doivent, en sus de la déclaration d'ensemble de leurs revenus n° 2042 (ci-dessous), produire au plus tard le 2e jour ouvré suivant le 1er mai de chaque année :<br /><br />

<ul>
    <li>Une déclaration n° 2035-SD ;</li>

<li>Les annexes n° 2035-A-SD et n° 2035-B-SD.</li>
</ul>
<br /><br />
Leur résultat apparaissant sur la 2035 sera alors reporté dans la case <b><u>5QC/5QI</u></b> ci-dessous.
<br /><br />
<div style="margin: auto; width: 75%">
<img src="/assets/FAQ_compta/FAQ_compta_2.png" style="width:100%"/>
</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <svg class = 'chevron' xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                Contrat de remplacement
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
                            <h2 style="padding-top: 15px; padding-bottom: 10px">Affiliation :</h2>

                            Obligation de signer un contrat de remplacement avec le médecin remplacé.

Envoi par le médecin remplacé de la licence et une demande d'autorisation de remplacement<br /><br />

Possibilité de l’éditer sur ce site :<br />

<a target="_blank" href="http://www.snjmg.org/remplacement/formulaire" style="display: flex; justify-content: center">http://www.snjmg.org/remplacement/formulaire</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    [...document.querySelectorAll('button[data-toggle="collapse"]')].map(el => el.addEventListener('click', function(){ 
        if (!el.classList.contains('collapsed')){return;}
        const y = el.getBoundingClientRect().top + window.scrollY;
        window.scroll({
          top: y,
          behavior: 'smooth'
        });
    }))
</script>   