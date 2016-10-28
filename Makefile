MAIN_BIN=/usr/local/bin

all:
	cp ./src/vgman.php ./src/vgm && chmod 775 ./src/vgm
	
install:
	install ./src/vgm $(MAIN_BIN)/vgm

uninstall:
	rm -f $(MAIN_BIN)/vgm && rm -f ./src/vgm