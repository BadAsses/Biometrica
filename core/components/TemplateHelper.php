<?php
namespace Core\Components;

/**
 * Клас TemplateHelper - компонент який допомагає збирати веб-сторінки із окремих модулів
 */
class TemplateHelper
{
    /** @var string Шлях до шаблону хедера сторінки */
    private static $header=HEADER;
    /** @var string Шлях до шаблону футера сторінки */
    private static $footer=FOOTER;
    /**
    * функція "збирає" веб сторінку із модулів та виводить її
    *@param array[]$modulesData містить дані для компонентів [$component1Data, $component2Data]
    *@param array[] $modulesPath масив,який містить шляхи до модулів,
    *@param string $page назва контроллеру для хедера
    *@param string $header шлях до шаблону хедера сторінки
    *@param string $footer шлях до шаблону футера сторінки
    *
    */
    public static function makePage(
        $modulesData,
        $modulesPath,
        $page = ''
    ) {
        include_once(self::$header);
        for ($i = 0; $i < count($modulesPath); $i++) {
            $componentData =$modulesData[$i];
            include_once($modulesPath[$i]);
        }
        include_once(self::$footer);
        return true;
    }
    /** функція "збирає" веб сторінку із модулів та виводить її
    *@param array[]$modulesData містить дані для компонентів [$component1Data, $component2Data]
    *@param array[] $modulesPath масив,який містить шляхи до модулів,
    *@param string $header шлях до шаблону хедера сторінки
    *@param string $footer шлях до шаблону футера сторінки
    *@return html сторніка html
    */
    public static function makeHtml(
        $modulesData,
        $modulesPath
    ) {
        include_once(self::$header);
        for ($i = 0; $i < count($modulesPath); $i++) {
            $componentData =$modulesData[$i];
            include_once($modulesPath[$i]);
        }
        include_once(self::$footer);
        return true;
    }
  ///////////////////////////////////////
  //////////////////////////////////////
  /////////////////////////////////////
  /**
     * Сеттер для TemplateHelper::$header
     * @param string $header Шлях до нового хедеру
     * @return void
     */
    public static function setHeader($header)
    {
        self::$header = $header;
    }
    /**
     * Сеттер для TemplateHelper::$footer
     * @param string $footer Шлях до нового футеру
     * @return void
     */
    public static function setFooter($footer)
    {
        self::$footer = $footer;
    }
    /**
     * Геттер для TemplateHelper::$header
     * @return string
     */
    public static function getHeader()
    {
        return self::$header;
    }
    /**
     * Геттер для TemplateHelper::$footer
     * @return string
     */
    public static function getFooter()
    {
        return self::$footer;
    }
}
