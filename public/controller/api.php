<?php

class Daily_News_With_Nati
{
    public function daily_news_api_request()
    {
        $url = 'https://newsapi.org/v2/top-headlines?country=us&category=entertainment&apiKey=f4c28468eadd47fda4e0ed2344989518';
        $response = wp_remote_get(
            $url,
            array(
                'timeout' => 120,
                'httpVersion' => '1.1',
                'headers' => array(
                    'User-Agent' => 'FastBusinessNews/1.0',
                ),
            )
        );
        if (!$response || is_wp_error($response)) {
            return false;
        }
        $res = wp_remote_retrieve_body($response);
        $response = json_decode($res);
        
        return $response;
    }

    public function daily_news_display() {
        return $this->daily_business_news_display();
    }

    public function display_hello_village() {
        return '<h1>Hello Village</h1>';
    }

    public function no_article_error_display() {
        return '<div class="err-container">
                    <p class="error-msg">Sorry, no news articles available right now.</p>
                </div>';
    }

    public function error_display($message = '') {
        return '<div class="err-container">
                    <p class="error-msg">Something went wrong.</p>
                    <p class="error-content">' . esc_html($message) . '</p>
                </div>';
    }

    public function daily_business_news_display() {
        ob_start();
    
        $response = $this->daily_news_api_request();
        
        if ($response) {

            if ($response->status != 'ok') {
                return $this->error_display($response->message);
            }
            
            $articles = $response->articles;
            if (!empty($articles)) {
                ?>
                <div class="news-container">
                    <?php
                    foreach ($articles as $article) {
                        ?>
                        <div class="news-card">
                            <h2 class="news-title">
                                <?php 
                                    $title = esc_html($article->title);
                                    echo mb_substr($title, 0, 80) . (mb_strlen($title) > 80 ? '...' : '');
                                ?>
                            </h2>
                            <?php if (!empty($article->urlToImage)) { ?>
                                <img class="news-img" src="<?php echo esc_url($article->urlToImage); ?>"
                                    alt="<?php echo esc_attr($article->title); ?>">
                            <?php } ?>
                            <p>
                                <?php 
                                    $description = esc_html($article->description);
                                    echo mb_substr($description, 0, 130) . (mb_strlen($description) > 130 ? '...' : '');
                                ?>
                            </p>
                            <div class="footer">
                                <a class="read-more" href="<?php echo esc_url($article->url); ?>" target="_blank">Read more</a>
                                <p class="author">By: <?php echo esc_html($article->author); ?></p>
                            </div>
                        </div>


                        <?php
                    }
                    ?>
                </div>
                <?php
            } else {
                return $this->no_article_error_display();
            }
        } else {
            return $this->no_article_error_display();
        }
    
        return ob_get_clean();
    }
}
