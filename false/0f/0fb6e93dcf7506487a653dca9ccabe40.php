<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* menu.html.twig */
class __TwigTemplate_296c3d1af41cdc915f49157e94c9438d extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!--
************************************************************************************************
**********************************************************
 MAIN SIDEBAR MENU

************************************************************************************************
*********************************************************** -->
 <!--sidebar start-->
 <aside>
 <div id=\"sidebar\" class=\"nav-collapse \">
 <!-- sidebar menu start-->
 <ul class=\"sidebar-menu\" id=\"nav-accordion\">
 <p class=\"centered\"><a href=\"profile.html\"><img src=\"web/img/greece-1162816_640.jpg\"
class=\"img-circle\" width=\"80\"></a></p>
 <h5 class=\"centered\">MJC Agora</h5>
 <li class=\"sub-menu\">
 <!--<?php if (isset(\$menuActif) && \$menuActif == 'Jeux') {echo 'class=\"active\"';} ?>
-->
 <a
 ";
        // line 20
        if ((array_key_exists("menuActif", $context) && (($context["menuActif"] ?? null) == "Jeux"))) {
            echo " class=\"active\" ";
        }
        // line 21
        echo " href=\"index.php\" ><i class=\"fa fa-desktop\"></i>
 <span>Jeux vidéos</span>
 </a>
 <ul class=\"sub\">
 <li><a href=\"index.php?uc=gererJeux&action=afficherJeux\">Jeux</a></li>
 <li><a href=\"index.php?uc=gererGenres&action=afficherGenres\">Genres</a></li>
 <li><a
href=\"index.php?uc=gererPlateformes&action=afficherPlateformes\">Plateformes</a></li>
 <li><a href=\"index.php?uc=gererMarques&action=afficherMarques\">Marques</a></li>
 <li><a href=\"index.php?uc=gererPegis&action=afficherPegis\">Pegi</a></li>
 <li><a href=\"index.php?uc=gererTournois&action=afficherTournois\">Tournois</a></li>
 </ul>
 </li>
 <li class=\"sub-menu\">
 <a
 ";
        // line 36
        if ((array_key_exists("menuActif", $context) && (($context["menuActif"] ?? null) == "Clubs"))) {
            echo " class=\"active\" ";
        }
        // line 37
        echo " href=\"javascript:;\">
 <i class=\"fa fa-group\"></i>
 <span>Clubs d'activités</span>
 </a>
 <ul class=\"sub\">
 <li><a href=\"index.php\">sous-menu 1</a></li>
 <li><a href=\"index.php\">sous-menu 2</a></li>
 <li><a href=\"index.php\">sous-menu 3</a></li>
 <li><a href=\"index.php\">sous-menu 4</a></li>
 <li><a href=\"index.php\">sous-menu 5</a></li>
 </ul>
 </li>

 <li class=\"sub-menu\">
 <a
 ";
        // line 52
        if ((array_key_exists("menuActif", $context) && (($context["menuActif"] ?? null) == "Formations"))) {
            echo " class=\"active\" 
 ";
        }
        // line 54
        echo " href=\"javascript:;\">
 <i class=\"fa fa-th\"></i>
<span>Formations</span>
 </a>
 <ul class=\"sub\">
 <li><a href=\"index.php\">sous-menu 1</a></li>
 <li><a href=\"index.php\">sous-menu 2</a></li>
 <li><a href=\"index.php\">sous-menu 3</a></li>
 <li><a href=\"index.php\">sous-menu 4</a></li>
 <li><a href=\"index.php\">sous-menu 5</a></li>
 </ul>
 </li>
 <li class=\"sub-menu\">
 <a
 ";
        // line 68
        if ((array_key_exists("menuActif", $context) && (($context["menuActif"] ?? null) == "Membres"))) {
            echo " class=\"active\" 
 ";
        }
        // line 70
        echo " href=\"javascript:;\">
 <i class=\"fa fa-user-md\"></i>
 <span>Membres</span>
 </a>
 <ul class=\"sub\">
 <li><a href=\"index.php\">sous-menu 1</a></li>
 <li><a href=\"index.php\">sous-menu 2</a></li>
 <li><a href=\"index.php\">sous-menu 3</a></li>
 <li><a href=\"index.php\">sous-menu 4</a></li>
 <li><a href=\"index.php\">sous-menu 5</a></li>
 </ul>
 </li>

 <li class=\"sub-menu\">
 <a
 ";
        // line 85
        if ((array_key_exists("menuActif", $context) && (($context["menuActif"] ?? null) == "Intervenants"))) {
            echo " class=\"active\" 
 ";
        }
        // line 87
        echo " href=\"javascript:;\">
 <i class=\"fa fa-smile-o\"></i>
 <span>Intervenants</span>
 </a>
 <ul class=\"sub\">
 <li><a href=\"index.php\">sous-menu 1</a></li>
 <li><a href=\"index.php\">sous-menu 2</a></li>
 <li><a href=\"index.php\">sous-menu 3</a></li>
 <li><a href=\"index.php\">sous-menu 4</a></li>
 <li><a href=\"index.php\">sous-menu 5</a></li>
 </ul>
 </li>
 </ul>
 <!-- sidebar menu end-->
 </div>
 </aside>
 <!--sidebar end-->
";
    }

    public function getTemplateName()
    {
        return "menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  148 => 87,  143 => 85,  126 => 70,  121 => 68,  105 => 54,  100 => 52,  83 => 37,  79 => 36,  62 => 21,  58 => 20,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!--
************************************************************************************************
**********************************************************
 MAIN SIDEBAR MENU

************************************************************************************************
*********************************************************** -->
 <!--sidebar start-->
 <aside>
 <div id=\"sidebar\" class=\"nav-collapse \">
 <!-- sidebar menu start-->
 <ul class=\"sidebar-menu\" id=\"nav-accordion\">
 <p class=\"centered\"><a href=\"profile.html\"><img src=\"web/img/greece-1162816_640.jpg\"
class=\"img-circle\" width=\"80\"></a></p>
 <h5 class=\"centered\">MJC Agora</h5>
 <li class=\"sub-menu\">
 <!--<?php if (isset(\$menuActif) && \$menuActif == 'Jeux') {echo 'class=\"active\"';} ?>
-->
 <a
 {% if menuActif is defined and menuActif == 'Jeux' %} class=\"active\" {% endif %}
 href=\"index.php\" ><i class=\"fa fa-desktop\"></i>
 <span>Jeux vidéos</span>
 </a>
 <ul class=\"sub\">
 <li><a href=\"index.php?uc=gererJeux&action=afficherJeux\">Jeux</a></li>
 <li><a href=\"index.php?uc=gererGenres&action=afficherGenres\">Genres</a></li>
 <li><a
href=\"index.php?uc=gererPlateformes&action=afficherPlateformes\">Plateformes</a></li>
 <li><a href=\"index.php?uc=gererMarques&action=afficherMarques\">Marques</a></li>
 <li><a href=\"index.php?uc=gererPegis&action=afficherPegis\">Pegi</a></li>
 <li><a href=\"index.php?uc=gererTournois&action=afficherTournois\">Tournois</a></li>
 </ul>
 </li>
 <li class=\"sub-menu\">
 <a
 {% if menuActif is defined and menuActif == 'Clubs' %} class=\"active\" {% endif %}
 href=\"javascript:;\">
 <i class=\"fa fa-group\"></i>
 <span>Clubs d'activités</span>
 </a>
 <ul class=\"sub\">
 <li><a href=\"index.php\">sous-menu 1</a></li>
 <li><a href=\"index.php\">sous-menu 2</a></li>
 <li><a href=\"index.php\">sous-menu 3</a></li>
 <li><a href=\"index.php\">sous-menu 4</a></li>
 <li><a href=\"index.php\">sous-menu 5</a></li>
 </ul>
 </li>

 <li class=\"sub-menu\">
 <a
 {% if menuActif is defined and menuActif == 'Formations' %} class=\"active\" 
 {% endif %}
 href=\"javascript:;\">
 <i class=\"fa fa-th\"></i>
<span>Formations</span>
 </a>
 <ul class=\"sub\">
 <li><a href=\"index.php\">sous-menu 1</a></li>
 <li><a href=\"index.php\">sous-menu 2</a></li>
 <li><a href=\"index.php\">sous-menu 3</a></li>
 <li><a href=\"index.php\">sous-menu 4</a></li>
 <li><a href=\"index.php\">sous-menu 5</a></li>
 </ul>
 </li>
 <li class=\"sub-menu\">
 <a
 {% if menuActif is defined and menuActif == 'Membres' %} class=\"active\" 
 {% endif %}
 href=\"javascript:;\">
 <i class=\"fa fa-user-md\"></i>
 <span>Membres</span>
 </a>
 <ul class=\"sub\">
 <li><a href=\"index.php\">sous-menu 1</a></li>
 <li><a href=\"index.php\">sous-menu 2</a></li>
 <li><a href=\"index.php\">sous-menu 3</a></li>
 <li><a href=\"index.php\">sous-menu 4</a></li>
 <li><a href=\"index.php\">sous-menu 5</a></li>
 </ul>
 </li>

 <li class=\"sub-menu\">
 <a
 {% if menuActif is defined and menuActif == 'Intervenants' %} class=\"active\" 
 {% endif %}
 href=\"javascript:;\">
 <i class=\"fa fa-smile-o\"></i>
 <span>Intervenants</span>
 </a>
 <ul class=\"sub\">
 <li><a href=\"index.php\">sous-menu 1</a></li>
 <li><a href=\"index.php\">sous-menu 2</a></li>
 <li><a href=\"index.php\">sous-menu 3</a></li>
 <li><a href=\"index.php\">sous-menu 4</a></li>
 <li><a href=\"index.php\">sous-menu 5</a></li>
 </ul>
 </li>
 </ul>
 <!-- sidebar menu end-->
 </div>
 </aside>
 <!--sidebar end-->
{# {% endblock %} #}
", "menu.html.twig", "C:\\wamp64\\www\\AgoraBO\\vue\\menu.html.twig");
    }
}
