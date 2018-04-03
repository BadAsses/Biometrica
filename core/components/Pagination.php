<?php
namespace Core\Components;

/** Клас Pagination - компонент для генерації елементів переходу сторінок */
class Pagination
{
    /** @var int Номер сторінки */
    private $currentPage;
    /** @var int Загальна кількість сторінок */
    private $pageNumber;
    /** @var string Рядок запиту */
    private $url;
    /** @deprecated Не використовується */
    private function __clone()
    {
    }
    /**
     * Створює екземпляр Pagination
     * @param int $currentPage номер сторінки
     * @param int $pageNumber кількість сторінок
     * @param string $url рядок запиту
     */
    public function __construct($currentPage, $pageNumber, $url)
    {
        $this->currentPage=$currentPage;
        $this->pageNumber=$pageNumber;
        $this->url=$url;
    }
    /** Виводить елемент переходу сторінок у вигляді html
     *  @return void
     */
    public function makeHtml()
    {
        /** Ліміт кнопок на сторінку (+3 включаючи стрілки та активну) */
        $linkLimit=4;
        /** Номер сторінки на яку посилається ліва стрілка */
        $firstLink=$this->currentPage-3;
        if ($firstLink<1) {
            $firstLink=1;
        }
        /** Номер сторінки на яку посилається права стрілка */
        $lastLink=$this->currentPage+3;
        if ($lastLink>$this->pageNumber) {
            $lastLink=$this->pageNumber;
        }
        /** Номер сторінки з якої пчинається відлік ліміту кнопок */
        $startNum=$this->currentPage-2;
        /** Перевірки для коректного відображення */
        if ($this->currentPage==$this->pageNumber) {
            $startNum=$this->currentPage-4;
        } elseif ($this->pageNumber-$this->currentPage==1) {
            $startNum=$this->currentPage-3;
        }
        if ($startNum<1) {
            $startNum=1;
        }
        ?>
      <div class="center">
      <div class="paginator">
        <?php
        /** Генерація кнопок у вигляді html */
            echo  "<a href='{$this->url}{$firstLink}' class='paginator__link'>&laquo;</a>";
        $forCount=$startNum+$linkLimit;
        if ($forCount>$this->pageNumber) {
            $forCount-=$forCount-$this->pageNumber;
        }
        for ($i=$startNum; $i<=$forCount; $i++) {
            if ($i>$this->pageNumber) {
                break;
            }
            if ($i==$this->currentPage) {
                echo  "<a href='{$this->url}{$i}' class='paginator__link--active'>{$i}</a>";
            } else {
                echo  "<a href='{$this->url}{$i}' class='paginator__link'>{$i}</a>";
            }
        }
        echo  "<a href='{$this->url}{$lastLink}' class='paginator__link'>&raquo;</a>";
        echo '</div>';
        echo '</div>';
    }
}
