copy-bundle:
	cd concepta-react; \
	npm install; \
	npm run build
	cp -v concepta-react/build/static/js/[0-9].*.js application/wp-content/themes/conceptainc/build/static/js/pre-bundle.js
	cp -v concepta-react/build/static/js/main.*.js application/wp-content/themes/conceptainc/build/static/js/bundle.js
	cp -v concepta-react/build/static/css/main.*.css application/wp-content/themes/conceptainc/build/static/css/bundle.css
