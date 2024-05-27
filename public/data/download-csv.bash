#!/usr/bin/env bash
url="https://docs.google.com/spreadsheets/d/1HiAh-hR8so0DbnYHOkMjdC3kuk9viC1BpZaZZL9bcZk/gviz/tq?tqx=out:csv&sheet"

for target in Item Room; do
    printf "%s\\n" "$target"
    curl --silent "$url=$target" > "./$target.csv"
done

