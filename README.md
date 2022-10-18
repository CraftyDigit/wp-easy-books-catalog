# easy-books-catalog
Small WP plugin for cataloguing books

## FAQ:
- The "EBC" menu item will appear after plugin activation. All catalogue management is available there. 
- Custom archive page. 
- The "ebc_list" shortcode is avalaible. It can be used to show the list of books. 
> [ebc_list ids="1,2,3"], where "1,2,3" - book post IDs.


## Development notes:
- Webpack. 
- dev/prod modes (npm run dev / npm run prod). In "dev" mode source maps for js/scss/css files are available. In "prod" mode js/scss/css files are minified.
- Bootstrap, sass, jquery, babel support enabled. 
