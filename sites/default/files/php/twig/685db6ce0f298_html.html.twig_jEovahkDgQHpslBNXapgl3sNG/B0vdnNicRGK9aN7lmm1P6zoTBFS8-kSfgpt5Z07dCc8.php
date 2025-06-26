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

/* themes/custom/google/templates/html.html.twig */
class __TwigTemplate_fbd3462d613118f9c1b6a730cac127e8 extends Template
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
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        $context["body_classes"] = [((        // line 3
($context["logged_in"] ?? null)) ? ("user-logged-in") : ("")), (( !        // line 4
($context["root_path"] ?? null)) ? ("path-frontpage") : (("path--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["root_path"] ?? null), 4, $this->source))))), ((        // line 5
($context["node_type"] ?? null)) ? (("page-node-type--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["node_type"] ?? null), 5, $this->source)))) : ("")), ((        // line 6
($context["db_offline"] ?? null)) ? ("db-offline") : (""))];
        // line 9
        echo "
<!DOCTYPE html>
<html ";
        // line 11
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["html_attributes"] ?? null), 11, $this->source), "html", null, true);
        echo ">
<head>
  <head-placeholder token=\"";
        // line 13
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null), 13, $this->source), "html", null, true);
        echo "\">
  <title>";
        // line 14
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->safeJoin($this->env, $this->sandbox->ensureToStringAllowed(($context["head_title"] ?? null), 14, $this->source), " | "));
        echo "</title>
  <css-placeholder token=\"";
        // line 15
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null), 15, $this->source), "html", null, true);
        echo "\">
  <js-placeholder token=\"";
        // line 16
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null), 16, $this->source), "html", null, true);
        echo "\">
</head>


<body";
        // line 20
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["body_classes"] ?? null)], "method", false, false, true, 20), 20, $this->source), "html", null, true);
        echo ">

<a href=\"#main-content\" class=\"visually-hidden focusable skip-link\">
";
        // line 23
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar("Skip to main content");
        echo "
</a>

  ";
        // line 26
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_top"] ?? null), 26, $this->source), "html", null, true);
        echo "
  ";
        // line 27
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page"] ?? null), 27, $this->source), "html", null, true);
        echo "
  ";
        // line 28
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_bottom"] ?? null), 28, $this->source), "html", null, true);
        echo "

  <js-bottom-placeholder token=\"";
        // line 30
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null), 30, $this->source), "html", null, true);
        echo "\">
</body>
</html>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["logged_in", "root_path", "node_type", "db_offline", "html_attributes", "placeholder_token", "head_title", "attributes", "page_top", "page", "page_bottom"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "themes/custom/google/templates/html.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  98 => 30,  93 => 28,  89 => 27,  85 => 26,  79 => 23,  73 => 20,  66 => 16,  62 => 15,  58 => 14,  54 => 13,  49 => 11,  45 => 9,  43 => 6,  42 => 5,  41 => 4,  40 => 3,  39 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/google/templates/html.html.twig", "/Applications/MAMP/htdocs/drupal10/themes/custom/google/templates/html.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 2);
        static $filters = array("clean_class" => 4, "escape" => 11, "safe_join" => 14);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set'],
                ['clean_class', 'escape', 'safe_join'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
