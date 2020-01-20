FROM shnjp/python-opencv-dlib

RUN apk update \
    && apk upgrade
# \&& apk add --no-cache bash \
# && adduser -D -H -u 1000 -s /bin/bash www-data

RUN apk add --no-cache python3-dev \
    uwsgi-python3 \
    && pip install --upgrade pip

COPY ./flask /app
WORKDIR /app

# #CUSTOM
# ENV PACKAGES="\
#     dumb-init \
#     musl \
#     libc6-compat \
#     linux-headers \
#     build-base \
#     bash \
#     git \
#     ca-certificates \
#     freetype \
#     libgfortran \
#     libgcc \
#     libstdc++ \
#     openblas \
#     tcl \
#     tk \
#     libssl1.0 \
#     "
# ENV PYTHON_PACKAGES="\ 
#     scipy \
#     " 
# RUN apk add --no-cache --virtual build-dependencies python --update py-pip \
#     && apk add --virtual build-runtime \
#     build-base python-dev openblas-dev freetype-dev pkgconfig gfortran \
#     && ln -s /usr/include/locale.h /usr/include/xlocale.h \
#     && pip install --upgrade pip \
#     && pip install --no-cache-dir $PYTHON_PACKAGES \
#     && apk del build-runtime \
#     && apk add --no-cache --virtual build-dependencies $PACKAGES \
#     && rm -rf /var/cache/apk/*
# #END CUSTOM

RUN apk add --virtual libatlas-base-dev gfortran git

RUN pip --no-cache-dir install -r requirements.txt

# CMD python app.py run 
CMD ["uwsgi", "uwsgi.ini"]