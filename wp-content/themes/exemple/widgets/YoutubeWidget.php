<?php
class YoutubeWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('youtube_widget', 'Youtube Widget');
    }

    public function widget($arg, $instance)
    {
        echo $arg['before_widget'];
        if ($instance['title']) {
            $title = apply_filters('widget_title', $instance['title']);
            echo $arg['before_title'] . $title . $arg['after_title'];
        }
        $youtube =  isset($instance['youtube']) ? $instance['youtube'] : '';
        echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . esc_attr($youtube) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        echo $arg['after_widget'];
    }
    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : "";
        $youtube = isset($instance['youtube']) ? $instance['youtube'] : "";
?>
        <p>
            <label for="<?= $this->get_field_name('title'); ?>">Titre</label>
            <input class="widefat" type="text" name="<?= $this->get_field_name('title'); ?>" id="<?= $this->get_field_name('title'); ?>" value="<?= esc_attr($title) ?>" />
        </p>
        <p>
            <label for="<?= $this->get_field_name('youtube'); ?>">Youtube</label>
            <input class="widefat" type="text" name="<?= $this->get_field_name('youtube'); ?>" id="<?= $this->get_field_name('youtube'); ?>" value="<?= esc_attr($youtube) ?>" />
        </p>
<?php
    }

    public function update($newInstance, $oldInstance)
    {
        return $newInstance;
    }
}


/* INTEGRATION WIDGET : the_widget (voir footer) */