<?php
class NewsShortCode
{
    private $modal;
  private $postdata=array();
  public function modal()
  {
    $this->post_data();
    $this->modal.=" <div class='custom-news' id='custom-news'>";
    $i=0;
    foreach($this->postdata as $postvalue){
        $i+=1;
        // $this->modal=$postvalue;
        $this->modal.="<div class='custom-news-enner-".$i."'id='custom-news-enner-".$i."'><h5>".$postvalue['publisher']."</h5>
            <a target='_blank' href='".$postvalue['publish-url']."'>".$postvalue['title']."</a>
        </div>";
    }
    $this->modal.="</div>";
    return $this;
  }
    public function post_data()
    {
        $args = array(
            'post_type' => 'news',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'orderby' => 'post_date',
            'order' => 'DESC',
        );
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
             $meta = get_post_meta(get_the_ID());
             $this->postdata[]=[
                'publisher'=>$meta['publisher'][0],
                'title'=>$meta['title'][0],
                'publish-url'=>$meta['publish-url'][0],
             ];
        endwhile;
        return $this;
    }
    public function createmodal()
    {
        return $this->modal;
    }
}
