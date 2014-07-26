# Gnu Makefile
#
DESTDIR ?=	/tmp
DISTNAME =	phpbb3-footnotes-mod.zip

SOURCES =	root install_mod.xml *.xsl

ZIP :=		$(shell which zip)

all:
ifeq (0, ${MAKELEVEL})
ifeq (,${ZIP})
	@echo "You need the zip program to create a distribution file."
else
	@(cd .. && \
	$(ZIP) -r $(DESTDIR)/$(DISTNAME) $(SOURCES))
endif
endif
