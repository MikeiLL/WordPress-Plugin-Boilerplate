<?php
namespace PLUGIN_NAME_Loader;

/**
 *
 * Based on: http://codereview.stackexchange.com/a/150308/318
 */

class Autoload {

    /**
     * @var string
     */
    private $namespace;
    /**
     * @var string
     */
    private $dir;
    /**
     * @var int
     */
    private $length;
    /**
     * Autoload constructor.
     *
     * @param string $namespace Pass the namespace unescaped.
     * @param string $dir
     */
    public function __construct( $namespace, $dir )
    {
        // Make sure it ends with a '\'.
        $namespace       = rtrim( $namespace, '\\' ) . '\\';
        $this->namespace = $namespace;
        $this->length    = strlen( $namespace );
        $this->dir       = rtrim( $dir, '/' ) . '/';
    }
    /**
     * @param string $search
     * @return void
     */
    public function load( $search )
    {
        if ( strncmp( $this->namespace, $search, $this->length ) !== 0 ) {
            return;
        }
        $name = substr( $search, $this->length );
        // Match Class Name to File Naming Convention
        $name = "class-" . strtolower(str_replace("_", "-", $name));
        $path = $this->dir . $name . '.php';
        if ( is_readable( $path ) ) {
            require $path;
        }
    }

}
