#!/bin/sh
#Se asume que bzip2, tar y find estan instalados
#No se realiza ninguna comprobacion extra...
#ramayac 07/oct/08

echo "Exito al comprimir la carpeta con todo su contenido."
echo "Generando copia del archivo con nuevo nombre..."
REV=`svn status --verbose | grep " . " | head -1` #retorna algo como: "32 32 ramayac ./archivo "
REV=${REV%[0-9]*} #encuentra el primer numero de derecha a izq: "32 3"
REV=${REV%" "*} #de la cadena anterior, obtiene del primer espacio en blanco hacia la izq: "32"

echo "Eliminando carpetas .svn"
DIRECTORIOS=`find . -type d -name .svn`
for DIR in $DIRECTORIOS
do [ -d $DIR ] #just in case :)
	#echo "Ejecutando: rm -r --force $DIR ..."
	rm -r --force $DIR #2>/dev/null
done
echo "Exito eliminando directorios svn"

echo "Eliminando archivos *.xfc"
ARCHIVOS=`find . -type d -name *.xfc`
for ARCH in $ARCHIVOS
do [ -d $ARCH ] #just in case :)
	#echo "Ejecutando: rm -r --force $ARCH ..."
	rm -r --force $ARCH #2>/dev/null
done
echo "Exito eliminando archivos *.xfc"

echo "Eliminando archivos *.wnk"
ARCHIVOS=`find . -type d -name *.wnk`
for ARCH in $ARCHIVOS
do [ -d $ARCH ] #just in case :)
	#echo "Ejecutando: rm -r --force $ARCH ..."
	rm -r --force $ARCH #2>/dev/null
done
echo "Exito eliminando archivos *.wnk"

echo "Comprimiendo Carpeta..."
DIR=`pwd`
tar -cf ./apollo.tar $DIR
bzip2 -z apollo.tar
rm apollo.tar

mv apollo.tar.bz Apollo.rev$REV.tar.bz
echo "Exito al crear: Apollo.rev$REV.tar.bz"
echo "FIN!"

