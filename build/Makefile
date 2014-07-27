# Gnu Makefile
#
DESTDIR ?=	/tmp
DISTNAME =	phpbb3-footnotes-mod-$(VERSION).zip

SOURCES =	root install_mod.xml *.xsl license.txt

VERSION =	$(shell git tag --list --sort=-refname | head -n1)

ZIP :=		$(shell which zip)

all:
ifeq (0, ${MAKELEVEL})
ifeq (,${VERSION})
	$(error You need the git program and/or a tag to create a distribution file.)
endif
ifeq (,${ZIP})
	$(error "You need the zip program to create a distribution file.)
else
	@(cd .. && \
	$(ZIP) -r $(DESTDIR)/$(DISTNAME) $(SOURCES))
endif
endif
