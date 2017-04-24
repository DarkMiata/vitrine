<?php

/**
 *
 */
class Categorie
  {

  /**
   * @var string
   */
  public $name;

  /**
   * @var string
   */
  public $url;

  /**
   * @var integer
   */
  public $countArticles;

  /**
   * @var \Article[]
   */
  public $listeArticles;

// ========================================
// ========================================
  public function get_countArticles() {
    return $this->countArticles;
  }
  public function get_url() {
    return $this->url;
  }
  public function get_name() {
    return $this->name;
  }

// ========================================

  public function set_countArticles($countArticles) {
    $this->countArticles = $countArticles;
  }
  public function set_name($name) {
    $this->name = $name;
  }
  public function set_url($url) {
    $this->url = $url;
  }
  // ========================================



  // ========================================
  // ========================================

  public function DB_is_categorie() {

  $bdd = DB_connexion();

  $name = $this->get_name();

  $reqSql = $bdd->query(
          " SELECT id"
          . " FROM " . DB_CAT
          . " WHERE name='$name';"
      )->fetch();

  return $$reqSql;
  }
  // ------------------------

  public function to_DB() {
    $req = DB_hydr_categorie(
        $this->get_name(),
        $this->get_url(),
        $this->get_countArticles()
    );

    return $req;
  }
  // ------------------------

  public function from_DB_by_id($id) {



  }
  // ------------------------

  public function scrap_PageCategorie($page) {

    $urlPage = $this->get_url() . "?p=$page";

    $html = file_get_html($urlPage);

    $blockListe    = $html->find('div[id=products_list]')[0];
    $blockArticles = $blockListe->find('li[class=product_list_block]');

    foreach ($blockArticles as $blockArt) {

      $urlArticle = $blockArt->find('a')[0]->attr['href'];

      // l'article existe dans la DB ?
      if (DB_is_articleByUrl($urlArticle) == FALSE) {

        $article = new Article;
        $article->scrap_pageArticle($urlArticle);
        $article->to_DB();

        $this->listeArticles[] = $article;
      }
    }

    //var_dump($blockListe);
    //var_dump($blockArticles);
  }

// ------------------------------
  public function hydrateFromArray(array $catArray) {

    $this->set_name($catArray['name']);
    $this->set_url($catArray['url']);
    $this->set_countArticles($catArray['countArticles']);

  }

// ========================================

}
