function last {
    array=("${@}")
    last_index=$(( $# - 1 ))
    last_item=${array[$last_index]}
    echo "$last_item"
}
python setup.py sdist
files=$( ls dist/*.tar.gz | sort -V )
lastfile=$( last $files )
version=${lastfile##*-}
version=${version%.tar.gz}
echo $version
twine check "$lastfile" || exit 1
twine upload "$lastfile"
sleep 10
python -m pip install string-between==$version
cmd /c "python -m pip install string-between==$version"
cmd /c "c:/Users/sfink/AppData/Local/Programs/Python/Python37/python.exe -m pip install string-between==$version"
cmd /c 'c:\Users\sfink\AppData\Local\Programs\Python\Python37\Scripts\pip.exe install string-between=='$version
