<?php
/**
 * ----------------------------------------
 * author : Mahmut ÖZDEMİR
 * web    : www.mahmutozdemir.com.tr
 * email  : bilgi@mahmutozdemir.com.tr
 * ----------------------------------------
 * Date   : 2021-10-15 14:55
 * File   : Paginator.php
 */

namespace Mahmut\Paginator;

class Paginator
{
    /**
     * page placeholder
     */
    const PLACEHOLDER = '{:page}';

    /**
     * total number of items
     *
     * @var int
     */
    protected $totalItems;

    /**
     * total pages
     *
     * @var int
     */
    protected $numPages;

    /**
     * total number of items per page. default is 20
     *
     * @var int
     */
    protected $itemsPerPage = 20;

    /**
     * the current page number. default is 1
     *
     * @var int
     */
    protected $currentPage;

    /**
     * max pages to show
     * @var int
     */
    protected $maxPagesToShow = 10;

    /**
     * a url for each page, with {:page} as a placeholder for the page number. Example: '/show/page/{:page}'
     *
     * @var string
     */
    protected $urlPattern;

    /**
     * pagination template
     *
     * @var string[]
     */
    protected $template = [
        'container' => '<ul class="pagination justify-content-center">{{pages}}</ul>',
        'current' => '<li class="page-item active"><span class="page-link">{{page}}</span></li>',
        'disabled' => '<li class="page-item disabled"><span class="page-link">{{page}}</span></li>',
        'page' => '<li class="page-item"><a class="page-link" href="{{url}}">{{page}}</a></li>',
        'ellipsis' => '...'
    ];

    /**
     * previous page text
     *
     * @var string
     */
    protected $previousText = 'Önceki';

    /**
     * next page text
     *
     * @var string
     */
    protected $nextText = 'Sonraki';

    /**
     * first page text
     *
     * @var string
     */
    protected $firstText = 'İlk';

    /**
     * last page text
     *
     * @var string
     */
    protected $lastText = 'Son';

    /**
     * show first page link
     *
     * @var bool
     */
    protected $showFirstPage = true;

    /**
     * show last page link
     *
     * @var bool
     */
    protected $showLastPage = true;

    /**
     * show previous page link
     *
     * @var bool
     */
    protected $showPreviousPage = true;

    /**
     * show next page link
     *
     * @var bool
     */
    protected $showNextPage = true;

    /**
     * Paginator constructor.
     *
     * @param $totalItems
     * @param $urlPattern
     * @param null $currentPage
     * @param null $itemsPerPage
     */
    public function __construct($totalItems, $itemsPerPage, $currentPage, $urlPattern)
    {
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = $currentPage;
        $this->urlPattern = $urlPattern;
        
        // calculate number of pages
        $this->calculateNumPages();
    }

    /**
     * calculate number of pages
     */
    protected function calculateNumPages()
    {
        $this->numPages = ($this->itemsPerPage == 0 ? 0 : (int) ceil($this->totalItems / $this->itemsPerPage));
    }

    /**
     * @return int
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }

    /**
     * @param int $totalItems
     * @return Paginator
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumPages()
    {
        return $this->numPages;
    }

    /**
     * @param int $numPages
     * @return Paginator
     */
    public function setNumPages($numPages)
    {
        $this->numPages = $numPages;
        return $this;
    }

    /**
     * @return int
     */
    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }

    /**
     * @param int $itemsPerPage
     * @return Paginator
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;

        // calculate number of pages
        $this->calculateNumPages();
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     * @return Paginator
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxPagesToShow()
    {
        return $this->maxPagesToShow;
    }

    /**
     * @param int $maxPagesToShow
     * @return Paginator
     */
    public function setMaxPagesToShow($maxPagesToShow)
    {
        if($maxPagesToShow < 3){
            throw new \InvalidArgumentException('maxPagesToShow cannot be less than 3');
        }

        $this->maxPagesToShow = $maxPagesToShow;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrlPattern()
    {
        return $this->urlPattern;
    }

    /**
     * @param string $urlPattern
     * @return Paginator
     */
    public function setUrlPattern($urlPattern)
    {
        $this->urlPattern = $urlPattern;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * paginator template
     *
     * @param array $template
     * @return $this
     */
    public function setTemplate(array $template)
    {
        $this->template = array_merge($this->template, $template);
        return $this;
    }

    /**
     * @return string
     */
    public function getPreviousText()
    {
        return $this->previousText;
    }

    /**
     * @param string $previousText
     * @return Paginator
     */
    public function setPreviousText($previousText)
    {
        $this->previousText = $previousText;
        return $this;
    }

    /**
     * @return string
     */
    public function getNextText()
    {
        return $this->nextText;
    }

    /**
     * @param string $nextText
     * @return Paginator
     */
    public function setNextText($nextText)
    {
        $this->nextText = $nextText;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstText()
    {
        return $this->firstText;
    }

    /**
     * @param string $firstText
     * @return Paginator
     */
    public function setFirstText($firstText)
    {
        $this->firstText = $firstText;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastText()
    {
        return $this->lastText;
    }

    /**
     * @param string $lastText
     * @return Paginator
     */
    public function setLastText($lastText)
    {
        $this->lastText = $lastText;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowFirstPage()
    {
        return $this->showFirstPage;
    }

    /**
     * @param bool $showFirstPage
     * @return Paginator
     */
    public function setShowFirstPage($showFirstPage)
    {
        $this->showFirstPage = $showFirstPage;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowLastPage()
    {
        return $this->showLastPage;
    }

    /**
     * @param bool $showLastPage
     * @return Paginator
     */
    public function setShowLastPage($showLastPage)
    {
        $this->showLastPage = $showLastPage;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowPreviousPage()
    {
        return $this->showPreviousPage;
    }

    /**
     * @param bool $showPreviousPage
     * @return Paginator
     */
    public function setShowPreviousPage($showPreviousPage)
    {
        $this->showPreviousPage = $showPreviousPage;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowNextPage()
    {
        return $this->showNextPage;
    }

    /**
     * @param bool $showNextPage
     * @return Paginator
     */
    public function setShowNextPage($showNextPage)
    {
        $this->showNextPage = $showNextPage;
        return $this;
    }

    /**
     * get page url
     *
     * @param $page
     * @return string
     */
    public function getPageUrl($page)
    {
        return str_replace(self::PLACEHOLDER, $page, $this->urlPattern);
    }

    /**
     * get next page number
     *
     * @return int|mixed|null
     */
    public function getNextPage()
    {
        if($this->currentPage < $this->numPages){
            return $this->currentPage + 1;
        }

        return null;
    }

    /**
     * get previous page number
     *
     * @return int|mixed|null
     */
    public function getPreviousPage()
    {
        if($this->currentPage > 1){
            return $this->currentPage - 1;
        }

        return null;
    }

    /**
     * get first page number
     *
     * @return int|null
     */
    public function getFirstPage()
    {
        if($this->currentPage > 1){
            return 1;
        }

        return null;
    }

    /**
     * get last page number
     *
     * @return int|null
     */
    public function getLastPage()
    {
        if($this->currentPage < $this->numPages){
            return $this->numPages;
        }

        return null;
    }

    /**
     * get next page url
     *
     * @return string|null
     */
    public function getNextPageUrl()
    {
        if(!$this->getNextPage())
            return null;

        return $this->getPageUrl($this->getNextPage());
    }

    /**
     * get previous page url
     *
     * @return string|null
     */
    public function getPreviousPageUrl()
    {
        if(!$this->getPreviousPage())
            return null;

        return $this->getPageUrl($this->getPreviousPage());
    }

    /**
     * get first page url
     *
     * @return string|null
     */
    public function getFirstPageUrl()
    {
        if(!$this->getFirstPage())
            return null;

        return $this->getPageUrl($this->getFirstPage());
    }

    /**
     * get last page url
     *
     * @return string|null
     */
    public function getLastPageUrl()
    {
        if(!$this->getLastPage())
            return null;

        return $this->getPageUrl($this->getLastPage());
    }

    /**
     * generate pages
     *
     * @return array
     */
    public function getPages()
    {
        $pages = [];

        if($this->numPages <= 1){
            return [];
        }

        if($this->numPages <= $this->maxPagesToShow){
            for($i = 1; $i <= $this->numPages; $i++){
                $pages[] = $this->createPage($i);
            }
        } else {
            $numAdjacents = (int) floor(($this->maxPagesToShow - 3) / 2);

            if($this->currentPage + $numAdjacents > $this->numPages){
                $slidingStart = $this->numPages - $this->maxPagesToShow + 2;
            } else {
                $slidingStart = $this->currentPage - $numAdjacents;
            }

            if($slidingStart < 2) $slidingStart = 2;

            $slidingEnd = $slidingStart + $this->maxPagesToShow - 3;
            if($slidingEnd >= $this->numPages) $slidingEnd = $this->numPages - 1;

            $pages[] = $this->createPage(1);

            if($slidingStart > 2){
                $pages[] = $this->createPageEllipsis();
            }

            for($i = $slidingStart; $i <= $slidingEnd; $i++){
                $pages[] = $this->createPage($i);
            }

            if($slidingEnd < $this->numPages - 1){
                $pages[] = $this->createPageEllipsis();
            }

            $pages[] = $this->createPage($this->numPages);
        }

        return $pages;
    }

    /**
     * create page
     *
     * @param $page
     * @return object
     */
    protected function createPage($page)
    {
        return (object) [
            'page' => htmlentities($page),
            'url' => htmlentities($this->getPageUrl($page)),
            'current' => $this->currentPage == $page
        ];
    }

    /**
     * create page ellipsis
     *
     * @return object
     */
    protected function createPageEllipsis()
    {
        return (object) [
            'page' => $this->template['ellipsis'],
            'url' => null,
            'current' => false
        ];
    }

    /**
     * render
     *
     * @return string
     */
    public function render()
    {
        if($this->numPages == 1){
            return '';
        }

        $html = '';
        if($this->isShowFirstPage()){
            if($this->getFirstPage()){
                $html .= str_replace(['{{page}}', '{{url}}'], [$this->getFirstText(), $this->getFirstPageUrl()], $this->template['page']);
            } else {
                $html .= str_replace('{{page}}', $this->getFirstText(), $this->template['disabled']);
            }
        }
        if($this->isShowPreviousPage()){
            if($this->getPreviousPage()){
                $html .= str_replace(['{{page}}', '{{url}}'], [$this->getPreviousText(), $this->getPreviousPageUrl()], $this->template['page']);
            } else {
                $html .= str_replace('{{page}}', $this->getPreviousText(), $this->template['disabled']);
            }
        }

        foreach($this->getPages() as $page){

            if($page->url){
                $html .= str_replace(['{{page}}', '{{url}}'], [$page->page, $page->url], $this->template[$page->current ? 'current' : 'page']);
            } else {
                $html .= str_replace('{{page}}', $page->page, $this->template['disabled']);
            }
        }

        if($this->isShowNextPage()){
            if($this->getNextPage()){
                $html .= str_replace(['{{page}}', '{{url}}'], [$this->getNextText(), $this->getNextPageUrl()], $this->template['page']);
            } else {
                $html .= str_replace('{{page}}', $this->getNextText(), $this->template['disabled']);
            }
        }
        if($this->isShowLastPage()){
            if($this->getLastPage()){
                $html .= str_replace(['{{page}}', '{{url}}'], [$this->getLastText(), $this->getLastPageUrl()], $this->template['page']);
            } else {
                $html .= str_replace('{{page}}', $this->getLastText(), $this->template['disabled']);
            }
        }

        return str_replace('{{pages}}', $html, $this->template['container']);
    }

    /**
     * @return string|string[]
     */
    public function __toString()
    {
        return $this->render();
    }
}