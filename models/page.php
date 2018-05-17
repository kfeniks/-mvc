<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 29.11.2017
 * Time: 19:14
 */

class Page extends Model {

    protected static $count_pages;

    public function getList( $only_published = false ) {

        $sql = 'select * from pages where 1';
        if ($only_published) {
            $sql .= 'and pages_is_published = 1';
        }

        return $this->db->query($sql);
    }

    public function getByAlias($alias) {

        $alias = $this->db->escape($alias);
        $sql = 'select * from pages where pages_alias = "'. $alias .'" limit 1';
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function getById($id) {

        $id = (int)$id;
        $sql = 'select * from pages where pages_id = "'. $id .'" limit 1';
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function save($data, $id = null) {

        if ( !isset($data['alias']) || !isset($data['title']) || !isset($data['content']) || !isset($data['is_published']) ) {

            return false;

        }

        $id = (int)$id;
        $alias = $this->db->escape($data['alias']);
        $title = $this->db->escape($data['title']);
        $content = $this->db->escape($data['content']);
        $is_published = isset($data['is_published']) ? 1 : 0;

        if ( !$id ) { // Add new record

            $sql = "
                insert into pages
                  set pages_alias = '$alias',
                      pages_title = '$title',
                      pages_content = '$content',
                      pages_is_published = '$is_published'
            ";

        } else { // Update existing record

            $sql = "
                update pages
                  set pages_alias = '$alias',
                      pages_title = '$title',
                      pages_content = '$content',
                      pages_is_published = '$is_published'
                  where pages_id = '$id'
            ";

        }

        return $this->db->query($sql);
    }

    public function getCount() {

        $sql = 'select pages_id from pages';

        $count_pages = $this->db->query($sql);

        self::$count_pages = count($count_pages);

        return !is_null(self::$count_pages);

    }

    public function delete($id) {

        $id = (int)$id;
        $sql = "delete from pages where pages_id = '$id'";

        return $this->db->query($sql);

    }

    public static function count() {

        echo self::$count_pages;
    }
}