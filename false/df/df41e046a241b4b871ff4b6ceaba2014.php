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

/* connexion.html.twig */
class __TwigTemplate_f4101d41c14f7abb0e6cf7f562956ba3 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("layout.html.twig", "connexion.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_central($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo "\t<!--
\t\t****************************************************************************************************
\t\t******************************************************
\t\t MAIN CONTENT
\t\t
\t\t****************************************************************************************************
\t\t******************************************************* -->
\t<div id=\"login-page\">
\t\t<div class=\"container connexion\">
\t\t\t<form class=\"form-login\" method=\"post\" action=\"index.php?uc=connexion\">
\t\t\t\t<h2 class=\"form-login-heading\">Identification utilisateur</h2>
\t\t\t\t<div class=\"login-wrap\">
\t\t\t\t\t";
        // line 15
        if (array_key_exists("erreur", $context)) {
            // line 16
            echo "\t\t\t\t\t\t<div class=\"erreurCnx\">
\t\t\t\t\t\t\t<p>";
            // line 17
            echo twig_escape_filter($this->env, ($context["erreur"] ?? null), "html", null, true);
            echo "</p>
\t\t\t\t\t\t</div>
\t\t\t\t\t";
        }
        // line 20
        echo "\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"txtLogin\" id=\"txtLogin\" placeholder=\"Login\" required autofocus/>
\t\t\t\t\t<br>
\t\t\t\t\t<input type=\"password\" class=\"form-control\" name=\"txtMdp\" id=\"txtMdp\" placeholder=\"Mot de
\t\t\t\t\t\t\t\t\t\t\t\tpasse\" required/>
\t\t\t\t\t<div
\t\t\t\t\t\tclass=\"pull-right login-social-link\">
\t\t\t\t\t\t<!--La version 5 du langage HTML a ajouté un nouveau type d'attribut, qui n'est pas
\t\t\t\t\t\t\t\t\t\t\t\tinterprété par le navigateur.
\t\t\t\t\t\t\t\t\t\t\t\t Ce sont tous les attributs dont le nom commence par les lettres data.
\t\t\t\t\t\t\t\t\t\t\t\t L'attribut data-toggle contient le type d'événement qui va être lié à un bouton
\t\t\t\t\t\t\t\t\t\t\t\t data-toggle=modal /* Bouton qui ouvre une fenêtre modale -->
\t\t\t\t\t\t<a data-toggle=\"modal\" href=\"v_connexion.php#myModal\">
\t\t\t\t\t\t\tMot de passe oublié ?</a>
\t\t\t\t\t</div>
\t\t\t\t\t<!-- l'événement onclick contient du code javascript pour hacher le mot de passe avec la
\t\t\t\t\t\t\t\t\t\tfonction de hachage SHA512
\t\t\t\t\t\t\t\t\t\t le résultat est stocké dans le champ caché qui sera transmis au serveur
\t\t\t\t\t\t\t\t\t\t document.getElementById('hdMdp').value : la valeur du champ caché hdMdp
\t\t\t\t\t\t\t\t\t\t document.getElementById('txtMdp').value : la valeur du champ saisi txtMdp
\t\t\t\t\t\t\t\t\t\t qui est mise à ' ' avant transmission au serveur pour ne pas
\t\t\t\t\t\t\t\t\t\tenvoyer le mdp en clair
\t\t\t\t\t\t\t\t\t\t hex_sha512 : fonction javascript de hachage sha512 avec retour du résultat en
\t\t\t\t\t\t\t\t\t\thexadecimal
\t\t\t\t\t\t\t\t\t\t -->
\t\t\t\t\t<button class=\"btn btn-theme btn-block\" type=\"submit\" name=\"cmdAction\" value=\"validerConnexion\" title=\"Se connecter\" onclick=\"document.getElementById('hdMdp').value =
\t\t\t\t\t\t\t\t\t\t\t\t\t\thex_sha512(document.getElementById('txtMdp').value);document.getElementById('txtMdp').value = ' ';\">
\t\t\t\t\t\t<i class=\"fa fa-lock\"></i>
\t\t\t\t\t\tSe connecter</button>
\t\t\t\t\t<!-- champ caché pour le mot de passe haché -->
\t\t\t\t\t<input type=\"hidden\" name=\"hdMdp\" id=\"hdMdp\"/>
\t\t\t\t\t<hr>
\t\t\t\t</div>

\t\t\t\t<!-- la fenêtre modale -->
\t\t\t\t<div aria-hidden=\"true\" aria-labelledby=\"myModalLabel\" role=\"dialog\" tabindex=\"-1\" id=\"myModal\" class=\"modal fade\">
\t\t\t\t\t<div class=\"modal-dialog\">
\t\t\t\t\t\t<div class=\"modal-content\">
\t\t\t\t\t\t\t<div class=\"modal-header\">
\t\t\t\t\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" ariahidden=\"true\">&times;</button>
\t\t\t\t\t\t\t\t<!-- data-dismiss ferme les fenêtres modales-->
\t\t\t\t\t\t\t\t<h4 class=\"modal-title\">Mot de passe oublié ?</h4>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"modal-body\">
\t\t\t\t\t\t\t\t<p>Entrez votre adresse mail pour réinitialiser votre mot de passe.</p>
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"txtEmail\" id=\"txtEmail\" placeholder=\"Email\" autocomplete=\"off\" class=\"form-control placeholder-no-fix\"/>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"modal-footer\">
\t\t\t\t\t\t\t\t<button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\">Cancel</button>
\t\t\t\t\t\t\t\t<button class=\"btn btn-theme\" type=\"button\">Submit</button>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<!-- modal -->
\t\t\t</form>
\t\t</div>
\t</div>
";
    }

    public function getTemplateName()
    {
        return "connexion.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 20,  69 => 17,  66 => 16,  64 => 15,  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout.html.twig\" %}
{% block central %}
\t<!--
\t\t****************************************************************************************************
\t\t******************************************************
\t\t MAIN CONTENT
\t\t
\t\t****************************************************************************************************
\t\t******************************************************* -->
\t<div id=\"login-page\">
\t\t<div class=\"container connexion\">
\t\t\t<form class=\"form-login\" method=\"post\" action=\"index.php?uc=connexion\">
\t\t\t\t<h2 class=\"form-login-heading\">Identification utilisateur</h2>
\t\t\t\t<div class=\"login-wrap\">
\t\t\t\t\t{% if (erreur is defined) %}
\t\t\t\t\t\t<div class=\"erreurCnx\">
\t\t\t\t\t\t\t<p>{{ erreur }}</p>
\t\t\t\t\t\t</div>
\t\t\t\t\t{% endif %}
\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"txtLogin\" id=\"txtLogin\" placeholder=\"Login\" required autofocus/>
\t\t\t\t\t<br>
\t\t\t\t\t<input type=\"password\" class=\"form-control\" name=\"txtMdp\" id=\"txtMdp\" placeholder=\"Mot de
\t\t\t\t\t\t\t\t\t\t\t\tpasse\" required/>
\t\t\t\t\t<div
\t\t\t\t\t\tclass=\"pull-right login-social-link\">
\t\t\t\t\t\t<!--La version 5 du langage HTML a ajouté un nouveau type d'attribut, qui n'est pas
\t\t\t\t\t\t\t\t\t\t\t\tinterprété par le navigateur.
\t\t\t\t\t\t\t\t\t\t\t\t Ce sont tous les attributs dont le nom commence par les lettres data.
\t\t\t\t\t\t\t\t\t\t\t\t L'attribut data-toggle contient le type d'événement qui va être lié à un bouton
\t\t\t\t\t\t\t\t\t\t\t\t data-toggle=modal /* Bouton qui ouvre une fenêtre modale -->
\t\t\t\t\t\t<a data-toggle=\"modal\" href=\"v_connexion.php#myModal\">
\t\t\t\t\t\t\tMot de passe oublié ?</a>
\t\t\t\t\t</div>
\t\t\t\t\t<!-- l'événement onclick contient du code javascript pour hacher le mot de passe avec la
\t\t\t\t\t\t\t\t\t\tfonction de hachage SHA512
\t\t\t\t\t\t\t\t\t\t le résultat est stocké dans le champ caché qui sera transmis au serveur
\t\t\t\t\t\t\t\t\t\t document.getElementById('hdMdp').value : la valeur du champ caché hdMdp
\t\t\t\t\t\t\t\t\t\t document.getElementById('txtMdp').value : la valeur du champ saisi txtMdp
\t\t\t\t\t\t\t\t\t\t qui est mise à ' ' avant transmission au serveur pour ne pas
\t\t\t\t\t\t\t\t\t\tenvoyer le mdp en clair
\t\t\t\t\t\t\t\t\t\t hex_sha512 : fonction javascript de hachage sha512 avec retour du résultat en
\t\t\t\t\t\t\t\t\t\thexadecimal
\t\t\t\t\t\t\t\t\t\t -->
\t\t\t\t\t<button class=\"btn btn-theme btn-block\" type=\"submit\" name=\"cmdAction\" value=\"validerConnexion\" title=\"Se connecter\" onclick=\"document.getElementById('hdMdp').value =
\t\t\t\t\t\t\t\t\t\t\t\t\t\thex_sha512(document.getElementById('txtMdp').value);document.getElementById('txtMdp').value = ' ';\">
\t\t\t\t\t\t<i class=\"fa fa-lock\"></i>
\t\t\t\t\t\tSe connecter</button>
\t\t\t\t\t<!-- champ caché pour le mot de passe haché -->
\t\t\t\t\t<input type=\"hidden\" name=\"hdMdp\" id=\"hdMdp\"/>
\t\t\t\t\t<hr>
\t\t\t\t</div>

\t\t\t\t<!-- la fenêtre modale -->
\t\t\t\t<div aria-hidden=\"true\" aria-labelledby=\"myModalLabel\" role=\"dialog\" tabindex=\"-1\" id=\"myModal\" class=\"modal fade\">
\t\t\t\t\t<div class=\"modal-dialog\">
\t\t\t\t\t\t<div class=\"modal-content\">
\t\t\t\t\t\t\t<div class=\"modal-header\">
\t\t\t\t\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" ariahidden=\"true\">&times;</button>
\t\t\t\t\t\t\t\t<!-- data-dismiss ferme les fenêtres modales-->
\t\t\t\t\t\t\t\t<h4 class=\"modal-title\">Mot de passe oublié ?</h4>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"modal-body\">
\t\t\t\t\t\t\t\t<p>Entrez votre adresse mail pour réinitialiser votre mot de passe.</p>
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"txtEmail\" id=\"txtEmail\" placeholder=\"Email\" autocomplete=\"off\" class=\"form-control placeholder-no-fix\"/>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"modal-footer\">
\t\t\t\t\t\t\t\t<button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\">Cancel</button>
\t\t\t\t\t\t\t\t<button class=\"btn btn-theme\" type=\"button\">Submit</button>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<!-- modal -->
\t\t\t</form>
\t\t</div>
\t</div>
{% endblock %}
", "connexion.html.twig", "C:\\wamp64\\www\\AgoraBO\\vue\\connexion.html.twig");
    }
}
