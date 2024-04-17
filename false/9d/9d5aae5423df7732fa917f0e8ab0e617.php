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

/* accueil.html.twig */
class __TwigTemplate_e31e3e1b543462f846b4a38a03cef4b3 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'central' => [$this, 'block_central'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout.html.twig", "accueil.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_central($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo "\t<!--
\t****************************************************************************************************
\t******************************************************
\t MAIN CONTENT
\t
\t****************************************************************************************************
\t******************************************************* -->
\t<div class=\"container\">
\t\t<div
\t\t\tid=\"blocImage\">

\t\t\t<!--<img src=\"vue/img/greece-1162816_640.jpg\" alt=\"Agora en Grèce\" class=\"responsive\">-->
\t\t\t<img src=\"web/img/greece-3348294_1280.jpg\" alt=\"\" class=\"responsive\">
\t\t\t<div
\t\t\t\tid=\"blocImageTexte\">
\t\t\t\t";
        // line 19
        echo "\t\t\t\tBonjour
\t\t\t\t";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "prenomUtilisateur", [], "any", false, false, false, 20), "html", null, true);
        echo "
\t\t\t\t";
        // line 21
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "nomUtilisateur", [], "any", false, false, false, 21), "html", null, true);
        echo "
\t\t\t</div>
\t\t</div>
\t</div>
";
    }

    public function getTemplateName()
    {
        return "accueil.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 21,  70 => 20,  67 => 19,  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout.html.twig\" %}
{% block central %}
\t<!--
\t****************************************************************************************************
\t******************************************************
\t MAIN CONTENT
\t
\t****************************************************************************************************
\t******************************************************* -->
\t<div class=\"container\">
\t\t<div
\t\t\tid=\"blocImage\">

\t\t\t<!--<img src=\"vue/img/greece-1162816_640.jpg\" alt=\"Agora en Grèce\" class=\"responsive\">-->
\t\t\t<img src=\"web/img/greece-3348294_1280.jpg\" alt=\"\" class=\"responsive\">
\t\t\t<div
\t\t\t\tid=\"blocImageTexte\">
\t\t\t\t{# Bonjour <?php echo \$_SESSION[\"prenomUtilisateur\"].' '.\$_SESSION[\"nomUtilisateur\"] ; ?>#}
\t\t\t\tBonjour
\t\t\t\t{{ session.prenomUtilisateur }}
\t\t\t\t{{ session.nomUtilisateur }}
\t\t\t</div>
\t\t</div>
\t</div>
{% endblock %}
", "accueil.html.twig", "C:\\wamp64\\www\\AgoraBO\\vue\\accueil.html.twig");
    }
}
